<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use RdKafka\KafkaConsumer;
use RdKafka\Message;

abstract readonly class Consumer
{
    public function __construct(protected KafkaConsumer $consumer, protected string $topicName)
    {
        $this->consumer->subscribe([$this->topicName]);
    }

    public function __invoke(): void
    {
        $this->start();
        try {
            while (true) {
                $this->preConsume();
                $message = $this->consumer->consume(120 * 1000);
                if ($this->isError($message)) {
                    if ($this->isErrorSkippable($message)) {
                        continue;
                    }

                    throw new \Exception($message->errstr(), $message->err);
                }

                $this->process($message);
                $this->consumer->commit($message);
                $this->postConsume();
            }
        } catch (\Exception $e) {
        }

        $this->finish();
    }

    abstract protected function start(): void;

    abstract protected function preConsume(): void;

    abstract protected function process(Message $kafkaMessage): void;

    abstract protected function postConsume(): void;

    abstract protected function finish(): void;

    protected function isError(Message $message): bool
    {
        return RD_KAFKA_RESP_ERR_NO_ERROR !== $message->err;
    }

    protected function isErrorSkippable(Message $message): bool
    {
        if (RD_KAFKA_RESP_ERR__TIMED_OUT === $message->err) {
            return true;
        }

        if (RD_KAFKA_RESP_ERR__PARTITION_EOF === $message->err) {
            return true;
        }

        return false;
    }
}
