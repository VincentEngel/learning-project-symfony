<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Shared\Application\Bus\Command\Command;

final class ExportPostCommand extends Command
{
    public const string QUEUE_NAME = 'post.export';

    public function __construct(
        public readonly string $id,
        public readonly string $event
    ) {
    }
}
