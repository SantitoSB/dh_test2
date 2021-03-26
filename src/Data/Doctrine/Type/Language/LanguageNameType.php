<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type\Language;

use App\Language\Model\Language\Name;
use App\Data\Doctrine\Type\StringType;

/**
 * LanguageNameType.
 */
class LanguageNameType extends StringType
{
    const NAME = 'language_language_name';

    protected function getClassName(): string
    {
        return Name::class;
    }
}
