<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPosts;

use App\Post\Domain\Post;

final class ListPosts
{
    /**
     * @return Post[]
     */
    public function __invoke(): array
    {
        return [];
    }
}