<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

/**
 * FloatValueObject.
 */
abstract class FloatValueObject extends AbstractValueObject
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function isEqualTo(self $value): bool
    {
        return $this->value === $value->getValue();
    }
}
