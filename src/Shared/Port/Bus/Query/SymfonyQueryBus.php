<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Query;

use App\Shared\Application\Bus\Query\Query;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Application\Bus\Query\QueryResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    use HandleTrait; // Using trait because ->handle() returns mixed

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function ask(Query $query): QueryResponse
    {
        return $this->handle($query);
    }
}
