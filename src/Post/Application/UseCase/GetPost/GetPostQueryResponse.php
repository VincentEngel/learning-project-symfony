<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Application\UseCase\Shared\Post;
use App\Post\Domain\Entity\Post as DomainEntityPost;
use App\Shared\Application\Bus\Query\QueryResponse;

final readonly class GetPostQueryResponse implements QueryResponse
{
    public function __construct(public Post $post)
    {
    }

    public static function fromPost(DomainEntityPost $post): self
    {
        return new self(Post::fromDomainEntityPost($post));
    }
}
