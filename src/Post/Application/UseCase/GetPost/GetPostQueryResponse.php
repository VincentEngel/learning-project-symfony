<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Application\UseCase\Shared\PostDto;
use App\Post\Domain\Entity\Post as DomainEntityPost;
use App\Shared\Application\Bus\Query\QueryResponseInterface;

final readonly class GetPostQueryResponse implements QueryResponseInterface
{
    public function __construct(public PostDto $post)
    {
    }

    public static function fromPost(DomainEntityPost $post): self
    {
        return new self(PostDto::fromDomainEntityPost($post));
    }
}
