<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPosts;

use App\Shared\Application\Bus\Query\QueryHandlerInterface;

final readonly class ListPostsQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ListPosts $listPosts)
    {
    }

    public function __invoke(ListPostsQuery $query): ListPostsQueryResponse
    {
        return ListPostsQueryResponse::fromDomainPostsArray($this->listPosts->__invoke());
    }
}
