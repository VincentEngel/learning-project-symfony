<?php

declare(strict_types=1);

namespace App\Tests\Unit\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidUuidException;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class UuidTest extends TestCase
{
    public function testOnlyValidUuidsAreAccepted(): void
    {
        $this->expectException(InvalidUuidException::class);
        new Uuid('invalid-uuid');
    }
}
