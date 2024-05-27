<?php

declare(strict_types=1);

namespace App\Post\Port\Persistence;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostContent;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use Doctrine\DBAL\Connection;

class MysqlPostRepository implements PostRepository
{
    public const string TABLE_NAME = 'posts';

    public function __construct(private readonly Connection $connection)
    {
    }

    public function save(Post $post): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->insert(self::TABLE_NAME)
            ->values([
                'id' => ':id',
                'content' => ':content',
                'parent_post_id' => ':parent_post_id',
            ])
            ->setParameters([
                'id' => $post->getId()->toPrimitive(),
                'content' => $post->getContent()->value(),
                'parent_post_id' => $post->getParentPostId()?->toPrimitive(),
            ]);

        $queryBuilder->executeStatement();
    }

    public function findByPostId(PostId $postId): ?Post
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from(self::TABLE_NAME)
            ->where('id = :id')
            ->setParameter('id', $postId->toPrimitive());
        $result = $queryBuilder->executeQuery()->fetchAssociative();
        if (false === $result) {
            return null;
        }

        return self::buildPostFromQueryResult($result);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->select('*')
            ->from(self::TABLE_NAME);

        $results = $queryBuilder->executeQuery()->fetchAllAssociative();

        $posts = [];

        foreach ($results as $result) {
            $posts[] = self::buildPostFromQueryResult($result);
        }

        return $posts;
    }

    public function findThreadByPostId(PostId $postId): array
    {
        $result = $this->connection->executeQuery(
            '
            WITH RECURSIVE parents AS (
                SELECT p.*
                FROM posts p
                WHERE p.id = "0059960d-a44a-4c92-8d1d-099be9fefdb9"
                UNION ALL
                SELECT p.*
                FROM posts p
                         INNER JOIN parents
                                ON p.id = parents.parent_post_id
            ),
            children AS (
                SELECT p.*
                FROM posts p
                         INNER JOIN parents ON p.parent_post_id = parents.id
            )
            
            SELECT * FROM parents
            UNION
            SELECT * FROM children;
            '
        );

        $results = $result->fetchAllAssociative();

        $posts = [];

        foreach ($results as $result) {
            $posts[] = self::buildPostFromQueryResult($result);
        }

        return $posts;
    }

    private static function buildPostFromQueryResult(array $postValues): Post
    {
        return new Post(
            id: new PostId($postValues['id']),
            content: new PostContent($postValues['content']),
            parentPostId: null !== $postValues['parent_post_id'] ? new PostId($postValues['parent_post_id']) : null,
        );
    }
}
