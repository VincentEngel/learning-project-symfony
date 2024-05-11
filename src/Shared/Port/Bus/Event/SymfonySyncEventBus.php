<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Event;

use App\Shared\Application\Bus\Event\EventBus;
use App\Shared\Domain\Events\DomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class SymfonySyncEventBus implements EventBus
{
    public function __construct(private MessageBusInterface $bus,)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->bus->dispatch($event);
        }
    }
}
