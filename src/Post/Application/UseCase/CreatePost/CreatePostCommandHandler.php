<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Shared\Application\Bus\Command\CommandHandler;

final class CreatePostCommandHandler implements CommandHandler
{
    public function __invoke(CreatePostCommand $command): void
    {
        // Can be avoided if the command passes an id instead
        $command->id = 'some_uuid';
    }
}