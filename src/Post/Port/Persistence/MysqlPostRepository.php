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
        if ($result === false) {
            return null;
        }

        return new Post(
            id: new PostId($result['id']),
            content: new PostContent($result['content']),
            parentPostId: $result['parent_post_id'] !== null ? new PostId($result['parent_post_id']) : null,
        );
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
            $posts[] = new Post(
                id: new PostId($result['id']),
                content: new PostContent($result['content']),
                parentPostId: $result['parent_post_id'] !== null ? new PostId($result['parent_post_id']) : null,
            );
        }

        return $posts;
    }
}
