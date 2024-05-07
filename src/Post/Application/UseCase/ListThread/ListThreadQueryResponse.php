<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Post\Application\UseCase\Shared\Post;
use App\Post\Domain\Entity\Post as DomainEntityPost;
use App\Shared\Application\Bus\Query\QueryResponse;

final readonly class ListThreadQueryResponse implements QueryResponse
{
    /**
     * @param Post[] $posts
     */
    public function __construct(public array $posts)
    {
    }

    /**
     * @param DomainEntityPost[] $domainPosts
     */
    public static function fromDomainPostsArray(array $domainPosts): self
    {
        return new ListThreadQueryResponse(
            array_map(
                fn (DomainEntityPost $post) => Post::fromDomainEntityPost($post),
                $domainPosts
            )
        );
    }
}
