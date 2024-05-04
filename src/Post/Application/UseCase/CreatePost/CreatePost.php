<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostContent;
use App\Post\Domain\Repository\PostRepository;

final readonly class CreatePost
{
    public function __construct(private PostRepository $postRepository)
    {
    }
    public function __invoke(PostContent $content): Post
    {
        $post = Post::createFromContent($content);
        $this->postRepository->save($post);
        return $post;
    }
}
