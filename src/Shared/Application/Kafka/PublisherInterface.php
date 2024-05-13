<?php

declare(strict_types=1);

namespace App\Shared\Application\Kafka;

interface PublisherInterface
{
    public function publish(MessageInterface $message): void;

    public function publishMultiple(MessagesHolderInterface $messageGenerator, int $flushLimit): void;
}
