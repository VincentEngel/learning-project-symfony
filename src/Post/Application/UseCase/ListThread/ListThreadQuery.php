<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Shared\Application\Bus\Query\QueryInterface;

final readonly class ListThreadQuery implements QueryInterface
{
    public function __construct(public string $postId)
    {
    }
}
