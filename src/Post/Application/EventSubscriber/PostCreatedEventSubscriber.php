<?php

declare(strict_types=1);

namespace App\Post\Application\EventSubscriber;

use App\Post\Domain\Events\PostCreatedEvent;
use App\Shared\Application\Bus\Event\DomainEventSubscriber;

final readonly class PostCreatedEventSubscriber implements DomainEventSubscriber
{
    public function __invoke(PostCreatedEvent $event): void
    {
    }
}
