<?php
declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

readonly class Uuid extends StringValueObject
{
    public function __construct(string $value)
    {
        self::guardAgainstInvalidUuid($value);
        parent::__construct($value);
    }

    public function toPrimitive(): string
    {
        return $this->value();
    }

    public static function createRandom(): self
    {
        return new self(SymfonyUuid::v4()->toRfc4122());
    }

    public function guardAgainstInvalidUuid(string $value): void
    {
        SymfonyUuid::isValid($value);
        // Add Exception
    }
}