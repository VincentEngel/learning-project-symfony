<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostContent;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use App\Shared\Application\Bus\Event\EventBus;

final readonly class CreatePost
{
    public function __construct(private PostRepository $postRepository, private EventBus $eventBus)
    {
    }
    public function __invoke(
        PostContent $content,
        ?PostId $parentPostId = null,
    ): Post {
        $post = Post::createFromUserInput(
            content: $content,
            parentPostId: $parentPostId,
        );

        $this->postRepository->save($post);

        $this->eventBus->publish(...$post->pullDomainEvents());

        return $post;
    }
}
