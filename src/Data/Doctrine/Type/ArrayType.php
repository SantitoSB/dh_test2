<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

/**
 * ArrayType.
 */
abstract class ArrayType extends JsonType
{
    abstract protected function getClassName(): string;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $className = $this->getClassName();
        return $value instanceof $className ? parent::convertToDatabaseValue($value->getValue(), $platform) : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);
        $className = $this->getClassName();
        return $value !== null ? new $className($value) : null;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
