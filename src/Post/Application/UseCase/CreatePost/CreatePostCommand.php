<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Shared\Application\Bus\Command\Command;

final class CreatePostCommand extends Command
{
    /**
     * $id is a "hack" to return the created post id.
     */
    public function __construct(
        public readonly string $content,
        public ?string $parentPostId = null,
        public ?string $generatedEntityId = null,
    ) {
    }
}
