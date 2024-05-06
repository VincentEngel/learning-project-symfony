<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPosts;

use App\Post\Application\UseCase\Shared\Post;
use App\Post\Domain\Entity\Post as DomainPost;
use App\Shared\Application\Bus\Query\QueryResponse;

final readonly class ListPostsQueryResponse implements QueryResponse
{
    /**
     * @param Post[] $posts
     */
    public function __construct(public array $posts)
    {
    }

    /**
     * @param DomainPost[] $domainPosts
     */
    public static function fromDomainPostsArray(array $domainPosts): self
    {
        return new ListPostsQueryResponse(
            array_map(
                fn (DomainPost $post) =>
                    new Post(
                        id: $post->getId()->toPrimitive(),
                        content: $post->getContent()->value(),
                    ),
                $domainPosts
            )
        );
    }
}
