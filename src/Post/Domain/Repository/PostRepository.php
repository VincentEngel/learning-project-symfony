<?php

declare(strict_types=1);

namespace App\Post\Domain\Repository;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostId;

interface PostRepository
{
    public function save(Post $post): void;
    public function findByPostId(PostId $postId): ?Post;

    /**
     * @return Post[]
     */
    public function findAll(): array;
}
