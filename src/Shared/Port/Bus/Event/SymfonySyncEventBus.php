<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Event;

use App\Shared\Application\Bus\Event\EventBusInterface;
use App\Shared\Domain\Events\DomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class SymfonySyncEventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->messageBus->dispatch($event);
        }
    }
}
