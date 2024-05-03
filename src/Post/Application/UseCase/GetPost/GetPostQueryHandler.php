<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Domain\Entity\Post;
use App\Post\Domain\Entity\PostId;
use App\Shared\Application\Bus\Query\QueryHandler;

final readonly class GetPostQueryHandler implements QueryHandler
{
    public function __construct(private GetPost $getPost)
    {
    }
    public function __invoke(GetPostQuery $query): GetPostQueryResponse
    {
        return GetPostQueryResponse::fromPost(
            $this->getPost->__invoke(new PostId($query->id))
        );
    }
}