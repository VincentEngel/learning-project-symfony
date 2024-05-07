<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Query\QueryHandler;

final readonly class ListThreadQueryHandler implements QueryHandler
{
    public function __construct(private ListThread $listThread)
    {
    }

    public function __invoke(ListThreadQuery $query): ListThreadQueryResponse
    {
        return ListThreadQueryResponse::fromDomainPostsArray($this->listThread->__invoke(new PostId($query->postId)));
    }
}
