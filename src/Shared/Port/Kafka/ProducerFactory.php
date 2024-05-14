<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use RdKafka\Conf;
use RdKafka\Producer;

final readonly class ProducerFactory
{
    public static function create(Conf $conf): Producer
    {
        return new Producer($conf);
    }
}
