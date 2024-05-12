<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;

final readonly class ExportPost
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function __invoke(PostId $postId): void
    {
        $post = $this->postRepository->findByPostId($postId);
    }
}
