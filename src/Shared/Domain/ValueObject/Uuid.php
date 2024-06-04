<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidUuidException;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

readonly class Uuid extends StringValueObject
{
    /**
     * @throws InvalidUuidException
     */
    public function __construct(string $content)
    {
        self::guardAgainstInvalidUuid($content);
        parent::__construct($content);
    }

    public function toPrimitive(): string
    {
        return $this->value();
    }

    public static function createRandom(): self
    {
        return new self(SymfonyUuid::v4()->toRfc4122());
    }

    /**
     * @throws InvalidUuidException
     */
    public function guardAgainstInvalidUuid(string $value): void
    {
        if (!SymfonyUuid::isValid($value)) {
            throw InvalidUuidException::fromUuid($value);
        }
    }
}
