<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type\Language;

use App\Language\Model\Language\Code;
use App\Data\Doctrine\Type\StringType;

/**
 * LanguageCodeType.
 */
class LanguageCodeType extends StringType
{
    const NAME = 'language_language_code';

    protected function getClassName(): string
    {
        return Code::class;
    }
}
