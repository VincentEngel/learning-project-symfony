<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;

class ListThread
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * @return Post[]
     */
    public function __invoke(PostId $postId): array
    {
        return $this->postRepository->findThreadByPostId($postId);
    }
}
