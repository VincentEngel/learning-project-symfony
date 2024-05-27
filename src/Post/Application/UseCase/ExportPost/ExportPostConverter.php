<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ExportPost;

use App\Post\Domain\Entity\Post as DomainPost;
use App\Shared\Domain\Enums\DomainEntityEvents;
use Post\Post as GpPost;

final readonly class ExportPostConverter
{
    public function __invoke(DomainPost $post, DomainEntityEvents $event): GpPost
    {
        $gpPost = new GpPost();
        $gpPost->setId($post->getId()->toPrimitive());
        $gpPost->setContent($post->getContent()->value());
        if ($post->getParentPostId()) {
            $gpPost->setParentId($post->getParentPostId()->toPrimitive());
        }

        $gpPost->setEvent(GpPost\Event::value($event->value));

        return $gpPost;
    }
}
