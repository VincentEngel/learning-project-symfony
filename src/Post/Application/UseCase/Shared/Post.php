<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Shared;

use App\Post\Domain\Entity\Post as DomainEntityPost;

readonly class Post
{
    public function __construct(
        public string $id,
        public string $content,
        public ?string $parentPostId = null,
    ) {
    }

    public static function fromDomainEntityPost(DomainEntityPost $post): self
    {
        return new self(
            id: $post->getId()->toPrimitive(),
            content: $post->getContent()->value(),
            parentPostId: $post->getParentPostId()?->toPrimitive(),
        );
    }
}
