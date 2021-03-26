<?php

declare(strict_types=1);

namespace App\UI\Http;

use App\Application\ValueObject\ArrayValueObject;
use App\Application\ValueObject\IntegerValueObject;
use App\Application\ValueObject\StringValueObject;
use App\Application\ValueObject\TextValueObject;
use App\Application\ValueObject\Uuid;
use App\Storage\Model\File\File;
use App\Storage\Service\File\Locator;
use DateTimeImmutable;

/**
 * Serializer.
 */
class Serializer
{
    public function asUuid(Uuid $id): string
    {
        return (string)$id;
    }

    public function asString(StringValueObject $value): string
    {
        return (string)$value;
    }

    public function asStringOrNull(?StringValueObject $value): ?string
    {
        return $value !== null ? $this->asString($value) : null;
    }

    public function asText(TextValueObject $value): ?string
    {
        return (string)$value;
    }

    public function asTextOrNull(?TextValueObject $value): ?string
    {
        return $value !== null ? $this->asText($value) : null;
    }

    public function asInt(IntegerValueObject $value): int
    {
        return $value->getValue();
    }

    public function asIntOrNull(?IntegerValueObject $value): ?int
    {
        return $value !== null ? $this->asInt($value) : null;
    }

    public function asArray(ArrayValueObject $value): array
    {
        return $value->getValue();
    }

    public function asArrayOrNull(?ArrayValueObject $value): ?array
    {
        return $value !== null ? $this->asArray($value) : null;
    }

    public function asDateTime(DateTimeImmutable $value): string
    {
        return $value->format(DateTimeImmutable::ATOM);
    }

    public function asDate(DateTimeImmutable $value): string
    {
        return $value->format('Y-m-d');
    }

    public function asDateOrNull(?DateTimeImmutable $value): ?string
    {
        return $value !== null ? $this->asDate($value) : null;
    }
}
