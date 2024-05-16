<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Event;

use App\Shared\Domain\Events\DomainEvent;

interface EventBusInterface
{
    public function publish(DomainEvent ...$events): void;
}
