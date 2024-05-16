<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Command;

abstract class Command implements CommandInterface
{
    public const string QUEUE_NAME = 'default';

    public static function getQueueName(): string
    {
        return static::QUEUE_NAME;
    }
}
