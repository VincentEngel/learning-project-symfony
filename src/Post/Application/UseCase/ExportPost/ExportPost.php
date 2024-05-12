<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use App\Shared\Domain\Enums\DomainEntityEvents;

final readonly class ExportPost
{
    public function __construct(
        private PostRepository $postRepository,
        private ExportPostConverter $exportPostConverter
    ) {
    }

    public function __invoke(PostId $postId, DomainEntityEvents $event): void
    {
        $post = $this->exportPostConverter->__invoke(
            post: $this->postRepository->findByPostId($postId),
            event: $event,
        );
    }
}
