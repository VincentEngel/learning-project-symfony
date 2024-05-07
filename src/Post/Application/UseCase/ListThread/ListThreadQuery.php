<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Shared\Application\Bus\Query\Query;

final readonly class ListThreadQuery implements Query
{
    public function __construct(public string $postId)
    {
    }
}
