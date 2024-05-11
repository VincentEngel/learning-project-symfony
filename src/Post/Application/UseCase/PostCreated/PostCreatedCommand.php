<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\PostCreated;

use App\Shared\Application\Bus\Command\Command;

final readonly class PostCreatedCommand implements Command
{
    public function __construct(public string $id)
    {
    }
}
