<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Domain\Post;
use App\Shared\Application\Bus\Query\QueryHandler;

final readonly class GetPostQueryHandler implements QueryHandler
{
    public function __invoke(GetPostQuery $query): GetPostQueryResponse
    {
        return GetPostQueryResponse::fromPost(new Post());
    }
}