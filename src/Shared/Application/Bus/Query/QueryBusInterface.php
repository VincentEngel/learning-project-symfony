<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Query;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): QueryResponseInterface;
}
