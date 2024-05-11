<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\PostCreated;

use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Command\CommandHandler;

final readonly class PostCreatedCommandHandler implements CommandHandler
{
    public function __construct(private PostCreated $postCreated)
    {
    }
    public function __invoke(PostCreatedCommand $command): void
    {
        $this->postCreated->__invoke(new PostId($command->id));
    }
}
