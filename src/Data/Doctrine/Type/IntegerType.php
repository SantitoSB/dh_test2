<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * IntegerType.
 */
abstract class IntegerType extends \Doctrine\DBAL\Types\IntegerType
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
        return $value !== null ? new $className((int)$value) : null;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
