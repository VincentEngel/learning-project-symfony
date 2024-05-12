<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Command\CommandHandler;
use App\Shared\Domain\Enums\DomainEntityEvents;

final readonly class ExportPostCommandHandler implements CommandHandler
{
    public function __construct(private ExportPost $postCreated)
    {
    }
    public function __invoke(ExportPostCommand $command): void
    {
        $this->postCreated->__invoke(
            postId: new PostId($command->id),
            event: DomainEntityEvents::from($command->event),
        );
    }
}
