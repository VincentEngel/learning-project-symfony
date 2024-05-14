<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use RdKafka\Conf;

final readonly class ConfigFactory
{
    public static function create(string $bootstrapServers, int $queueBufferingMaxMessages,): Conf
    {
        $conf = new Conf();
        $conf->set('bootstrap.servers', $bootstrapServers);
        $conf->set('queue.buffering.max.messages', (string) $queueBufferingMaxMessages);
        return $conf;
    }
}
