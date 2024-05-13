<?php

declare(strict_types=1);

namespace App\Shared\Application\Kafka;

interface MessagesHolderInterface
{
    /**
     * @return MessageInterface[]
     */
    public function messages(): array;
}
