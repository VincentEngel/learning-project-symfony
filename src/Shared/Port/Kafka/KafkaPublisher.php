<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use App\Shared\Application\Kafka\MessageInterface;
use App\Shared\Application\Kafka\MessagesHolderInterface;
use App\Shared\Application\Kafka\PublisherInterface;
use RdKafka\Producer;
use RdKafka\ProducerTopic;

final readonly class KafkaPublisher implements PublisherInterface
{
    private ProducerTopic $topic;
    public function __construct(
        private Producer $producer,
        private string $topicName,
        private int $flushTimeout = 1000,
    ) {
        $this->topic = $this->producer->newTopic($this->topicName);
    }

    public function publish(MessageInterface $message): void
    {
        $this->produce($message);
        $this->flush();
    }

    public function publishMultiple(MessagesHolderInterface $messageGenerator, int $flushLimit): void
    {
        $count = 0;

        foreach ($messageGenerator->messages() as $message) {
            $this->produce($message);
            $count++;

            if ($count >= $flushLimit) {
                $count = 0;
                $this->flush();
            }
        }
    }

    private function produce(MessageInterface $message): void
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, (string) $message);
    }

    private function flush(): void
    {
        $this->producer->flush($this->flushTimeout);
    }
}
