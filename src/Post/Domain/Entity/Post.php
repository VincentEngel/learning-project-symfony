<?php

declare(strict_types=1);

namespace App\Post\Domain\Entity;

use App\Post\Domain\Events\PostCreatedEvent;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Exceptions\InvalidUuidException;
use App\Shared\Domain\ValueObject\Uuid;

final class Post extends AggregateRoot
{
    public function __construct(
        private readonly PostId $id,
        private PostContent $content,
        private ?PostId $parentPostId = null,
    ) {
        $this->record(new PostCreatedEvent($this->id->toPrimitive()));
    }

    /**
     * @throws InvalidUuidException
     */
    public static function createFromUserInput(
        PostContent $content,
        ?PostId $parentPostId = null,
    ): Post {
        return new Post(
            id: new PostId(Uuid::createRandom()->toPrimitive()),
            content: $content,
            parentPostId: $parentPostId,
        );
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function getParentPostId(): ?PostId
    {
        return $this->parentPostId;
    }
}
