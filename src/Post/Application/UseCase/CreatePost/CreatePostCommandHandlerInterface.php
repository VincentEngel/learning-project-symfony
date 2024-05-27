<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Post\Domain\Entity\PostContent;
use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Command\CommandHandlerInterface;

final readonly class CreatePostCommandHandlerInterface implements CommandHandlerInterface
{
    public function __construct(private CreatePost $createPost)
    {
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $post = $this->createPost->__invoke(
            content: new PostContent($command->content),
            parentPostId: null !== $command->parentPostId ? new PostId($command->parentPostId) : null
        );

        // Can be avoided if the command passes an id instead
        $command->generatedEntityId = $post->getId()->toPrimitive();
    }
}
