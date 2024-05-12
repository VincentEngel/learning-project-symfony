<?php

declare(strict_types=1);

namespace App\Shared\Port\Bus\Query;

use App\Shared\Application\Bus\Query\Query;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Application\Bus\Query\QueryResponse;
use Symfony\Component\Messenger\HandleTrait;

class SymfonyQueryBus implements QueryBus
{
    use HandleTrait; // Using trait because ->handle() returns mixed

    public function ask(Query $query): QueryResponse
    {
        return $this->handle($query);
    }
}
