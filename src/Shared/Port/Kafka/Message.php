<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use App\Shared\Application\Kafka\MessageInterface;

final readonly class Message implements MessageInterface
{
    public function __construct(private string $message)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
