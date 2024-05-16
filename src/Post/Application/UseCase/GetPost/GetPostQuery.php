<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Shared\Application\Bus\Query\QueryInterface;

final readonly class GetPostQuery implements QueryInterface
{
    public function __construct(public string $id)
    {
    }
}
