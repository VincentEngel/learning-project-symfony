<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\CreatePost;

use App\Shared\Application\Bus\Command\Command;

final class CreatePostCommand implements Command
{
    /**
     * $id is a "hack" to return the created post id
     */
    public function __construct(
        public readonly string $content,
        public ?string $id = null
    ) {
    }
}
