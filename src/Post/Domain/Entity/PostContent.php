<?php

declare(strict_types=1);

namespace App\Post\Domain\Entity;

use App\Post\Domain\Exceptions\InvalidPostContentException;
use App\Shared\Domain\ValueObject\StringValueObject;

final readonly class PostContent extends StringValueObject
{
    /**
     * @throws InvalidPostContentException
     */
    public function __construct(string $content)
    {
        self::guardAgainstEmptyContent($content);
        parent::__construct($content);
    }

    /**
     * @throws InvalidPostContentException
     */
    private static function guardAgainstEmptyContent(string $content): void
    {
        if (empty($content)) {
            throw InvalidPostContentException::emptyContent();
        }
    }
}
