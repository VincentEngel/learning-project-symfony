<?php
declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract readonly class StringValueObject
{
    public function __construct(
        protected string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isEqual(StringValueObject $object): bool
    {
        return $this->value() === $object->value();
    }
}