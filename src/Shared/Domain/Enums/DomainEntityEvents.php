<?php
declare(strict_types=1);

namespace App\Shared\Domain\Enums;

enum DomainEntityEvents: string
{
    case CREATED = 'CREATED';
}