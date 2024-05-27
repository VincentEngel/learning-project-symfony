<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Query;

use App\Shared\Application\Bus\Query\QueryBusInterface;
use App\Shared\Application\Bus\Query\QueryInterface;
use App\Shared\Application\Bus\Query\QueryResponseInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBusInterface
{
    use HandleTrait; // Using trait because ->handle() returns mixed

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function ask(QueryInterface $query): QueryResponseInterface
    {
        return $this->handle($query);
    }
}
