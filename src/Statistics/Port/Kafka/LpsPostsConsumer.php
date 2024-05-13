<?php

declare(strict_types=1);

namespace App\Statistics\Port\Kafka;

use App\Shared\Port\Kafka\Consumer;
use RdKafka\KafkaConsumer;
use RdKafka\Message;

final readonly class LpsPostsConsumer extends Consumer
{
    public function __construct(private PostConverter $postConverter, KafkaConsumer $consumer, string $topicName,)
    {
        parent::__construct(consumer: $consumer, topicName: $topicName);
    }

    protected function start(): void
    {
    }

    protected function preConsume(): void
    {
    }

    protected function process(Message $kafkaMessage): void
    {
        echo "Processing message\n";
        $post = ($this->postConverter)($kafkaMessage);
        var_dump($post);
    }

    protected function postConsume(): void
    {
    }

    protected function finish(): void
    {
    }
}
