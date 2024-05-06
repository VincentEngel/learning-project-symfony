<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPosts;

use App\Shared\Application\Bus\Query\QueryHandler;

final readonly class ListPostsQueryHandler implements QueryHandler
{
    public function __construct(private ListPosts $listPosts)
    {
    }

    public function __invoke(ListPostsQuery $query): ListPostsQueryResponse
    {
        return ListPostsQueryResponse::fromDomainPostsArray($this->listPosts->__invoke());
    }
}
