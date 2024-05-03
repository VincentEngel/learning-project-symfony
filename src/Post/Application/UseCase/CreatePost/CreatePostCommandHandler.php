<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Post\Domain\Entity\PostContent;
use App\Shared\Application\Bus\Command\CommandHandler;

final class CreatePostCommandHandler implements CommandHandler
{
    public function __construct(private readonly CreatePost $createPost)
    {
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $post = $this->createPost->__invoke(
            new PostContent($command->content)
        );

        // Can be avoided if the command passes an id instead
        $command->id = $post->getId()->toPrimitive();
    }
}