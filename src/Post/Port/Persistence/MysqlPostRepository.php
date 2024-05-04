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
    public const TABLE_NAME = 'posts';
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
            ])
            ->setParameters([
                'id' => $post->getId()->toPrimitive(),
                'content' => $post->getContent()->value(),
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

        return new Post(new PostId($result['id']), new PostContent($result['content']),);
    }
}
