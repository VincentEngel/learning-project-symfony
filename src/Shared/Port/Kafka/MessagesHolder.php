<?php

declare(strict_types=1);

namespace App\Shared\Port\Kafka;

use App\Shared\Application\Kafka\MessageInterface;
use App\Shared\Application\Kafka\MessagesHolderInterface;

final readonly class MessagesHolder implements MessagesHolderInterface
{
    /**
     * @param MessageInterface[] $messages
     */
    public function __construct(private array $messages)
    {
    }

    public function messages(): array
    {
        return $this->messages;
    }
}
