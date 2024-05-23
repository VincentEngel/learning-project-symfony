<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use App\Shared\Application\Kafka\PublisherInterface;
use App\Shared\Domain\Enums\DomainEntityEvents;
use App\Shared\Port\Kafka\Message;

final readonly class ExportPost
{
    public function __construct(
        private PostRepository $postRepository,
        private ExportPostConverter $exportPostConverter,
        private PublisherInterface $publisher,
    ) {
    }

    public function __invoke(PostId $postId, DomainEntityEvents $event): void
    {
        $post = $this->exportPostConverter->__invoke(
            post: $this->postRepository->findByPostId($postId),
            event: $event,
        );

        // use $post->serializeToString() for smaller payload
        $this->publisher->publish(new Message($post->serializeToJsonString()));
    }
}
