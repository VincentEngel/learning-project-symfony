<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Shared;

readonly class Post
{
    public function __construct(public string $id, public string $content,)
    {
    }
}
