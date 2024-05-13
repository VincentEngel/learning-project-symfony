<?php

declare(strict_types=1);

namespace App\Shared\Application\Kafka;

interface MessageInterface
{
    public function __toString(): string;
}
