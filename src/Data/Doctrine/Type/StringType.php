<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * StringType.
 */
abstract class StringType extends \Doctrine\DBAL\Types\StringType
{
    abstract protected function getClassName(): string;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $className = $this->getClassName();
        return $value instanceof $className ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->getClassName();
        return $value !== null ? new $className((string)$value) : null;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
