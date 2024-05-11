<?php

declare(strict_types=1);

namespace App\Shared\Domain\Events;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

abstract readonly class DomainEvent
{
    public string $eventId;
// Pass along the previous event id so that we can track the event flow
    public string $occurredOn;
    public function __construct(public string $aggregateId, ?string $eventId = null, ?string $occurredOn = null,)
    {
        $this->eventId = $eventId ?? SymfonyUuid::v4()->toRfc4122();
        $this->occurredOn = $occurredOn ?? (new DateTimeImmutable())->format(DATE_ATOM);
    }
}
