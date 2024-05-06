<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exceptions;

final class InvalidUuidException extends DomainException
{
    public static function fromUuid(string $uuid): self
    {
        return new self(sprintf('The provided UUID "%s" is not valid.', $uuid));
    }
}
