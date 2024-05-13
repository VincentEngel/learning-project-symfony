<?php

declare(strict_types=1);

namespace App\Statistics\Port\Kafka;

use Post\Post as GpPost;
use RdKafka\Message;

final readonly class PostConverter
{
    public function __invoke(Message $message): GpPost
    {
        return new GpPost(json_decode($message->payload, true));
    }
}
