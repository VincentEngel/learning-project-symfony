<?php

declare(strict_types=1);

namespace App\Post\Domain\Events;

use App\Shared\Domain\Events\DomainEvent;

final readonly class PostCreatedEvent extends DomainEvent
{
}
