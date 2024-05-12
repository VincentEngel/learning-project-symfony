<?php

declare(strict_types=1);

namespace App\Post\Application\EventSubscriber;

use App\Post\Application\UseCase\ExportPost\ExportPostCommand;
use App\Post\Domain\Events\PostCreatedEvent;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Event\DomainEventSubscriber;

final readonly class PostCreatedEventSubscriber implements DomainEventSubscriber
{
    public function __construct(private CommandBus $commandBus)
    {
    }
    public function __invoke(PostCreatedEvent $event): void
    {
        $this->commandBus->dispatch(new ExportPostCommand(
            $event->aggregateId,
            $event::EVENT_NAME,
        ));
    }
}
