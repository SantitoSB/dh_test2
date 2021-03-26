<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

/**
 * ArrayValueObject.
 */
abstract class ArrayValueObject extends AbstractValueObject
{
    protected array $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
