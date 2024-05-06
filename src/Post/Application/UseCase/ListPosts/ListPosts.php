<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPosts;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Repository\PostRepository;

final class ListPosts
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * @return Post[]
     */
    public function __invoke(): array
    {
        return $this->postRepository->findAll();
    }
}
