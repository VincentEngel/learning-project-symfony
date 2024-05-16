<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Post\Application\UseCase\Shared\PostDto;
use App\Post\Domain\Entity\Post as DomainEntityPost;
use App\Shared\Application\Bus\Query\QueryResponseInterface;

final readonly class ListThreadQueryResponse implements QueryResponseInterface
{
    /**
     * @param PostDto[] $posts
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
                fn (DomainEntityPost $post) => PostDto::fromDomainEntityPost($post),
                $domainPosts
            )
        );
    }
}
