<?php
declare(strict_types=1);

namespace App\Shared\Domain\Events;

use App\Shared\Domain\Enums\DomainEntityEvents;

abstract readonly class DomainEntityCreatedEvent extends DomainEvent
{
    public const string EVENT_NAME = DomainEntityEvents::CREATED->value;
}