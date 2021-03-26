<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

/**
 * AbstractValueObject.
 */
abstract class AbstractValueObject
{
    public function getPropertyPath(): ?string
    {
        return null;
    }

    public function getPropertyLabel(): ?string
    {
        return null;
    }
}
