<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Command;

use App\Shared\Application\Bus\Command\CommandInterface;
use App\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class SymfonyCommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $envelope = new Envelope($command, [new AmqpStamp($command::getQueueName())]);
        $this->messageBus->dispatch($envelope);
    }
}
