<?php
declare(strict_types=1);

namespace App\Post\Application\UseCase\GetPost;

use App\Post\Domain\Entity\Post;
use App\Shared\Application\Bus\Query\QueryResponse;

final readonly class GetPostQueryResponse implements QueryResponse
{
    public function __construct(
        public string $id,
        public string $content,
    )
    {
    }

    public static function fromPost(Post $post): self
    {
        return new self(
            id: $post->getId()->toPrimitive(),
            content: $post->getContent()->value(),
        );
    }
}