<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Shared\Application\Bus\Query\Query;

final readonly class GetPostQuery implements Query
{
    public function __construct(public string $id)
    {
    }
}
