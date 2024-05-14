<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use RdKafka\Conf;

final readonly class ConsumerConfigFactory
{
    public static function create(string $bootstrapServers, string $groupId,): Conf
    {
        $conf = new Conf();
        $conf->set('bootstrap.servers', $bootstrapServers);
        $conf->set('group.id', $groupId);
        $conf->set('enable.partition.eof', 'true');
        $conf->set('auto.offset.reset', 'earliest');
        return $conf;
    }
}
