<?php

declare(strict_types=1);

namespace App\Post\Domain\Exceptions;

use App\Shared\Domain\Exceptions\DomainException;

class InvalidPostContentException extends DomainException
{
    public static function emptyContent(): self
    {
        return new self('Post content cannot be empty');
    }
}
