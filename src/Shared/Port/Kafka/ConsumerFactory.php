<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use RdKafka\Conf;
use RdKafka\KafkaConsumer;

final readonly class ConsumerFactory
{
    public static function create(Conf $conf): KafkaConsumer
    {
        return new KafkaConsumer($conf);
    }
}
