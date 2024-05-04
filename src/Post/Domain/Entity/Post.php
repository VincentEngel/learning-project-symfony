<?php

declare(strict_types=1);

namespace App\Post\Domain\Entity;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;

final class Post extends AggregateRoot
{
    public function __construct(private PostId $id, private PostContent $content,)
    {
    }

    public static function createFromContent(PostContent $content): Post
    {
        return new Post(new PostId(Uuid::createRandom()->toPrimitive()), $content,);
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function getId(): PostId
    {
        return $this->id;
    }
}
