<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type\Language;

use App\Data\Doctrine\Type\IntegerType;
use App\Language\Model\Language\NewField;


/**
 * LanguageNewFieldType.
 */
class LanguageNewFieldType extends IntegerType
{
    const NAME = 'language_language_new_field';

    protected function getClassName(): string
    {
        return NewField::class;
    }
}