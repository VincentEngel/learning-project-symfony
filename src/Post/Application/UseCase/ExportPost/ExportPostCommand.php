<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Shared\Application\Bus\Command\Command;

final readonly class ExportPostCommand implements Command
{
    public function __construct(public string $id, public string $event)
    {
    }
}
