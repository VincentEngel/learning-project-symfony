<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;

final readonly class GetPost
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function __invoke(PostId $postId): Post
    {
        // Add Exception
        return $this->postRepository->findByPostId($postId);
    }
}