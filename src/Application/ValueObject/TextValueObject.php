<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

/**
 * TextValueObject.
 */
abstract class TextValueObject extends AbstractValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEqualTo(self $value): bool
    {
        return $this->value === $value->getValue();
    }
}
