<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListThread;

use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Query\QueryHandlerInterface;

final readonly class ListThreadQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ListThread $listThread)
    {
    }

    public function __invoke(ListThreadQuery $query): ListThreadQueryResponse
    {
        return ListThreadQueryResponse::fromDomainPostsArray($this->listThread->__invoke(new PostId($query->postId)));
    }
}
