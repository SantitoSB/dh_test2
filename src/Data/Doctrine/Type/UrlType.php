<?php

declare(strict_types=1);

namespace App\Data\Doctrine\Type;

use App\Application\ValueObject\Url;

/**
 * UrlType.
 */
class UrlType extends StringType
{
    const NAME = 'url';

    protected function getClassName(): string
    {
        return Url::class;
    }
}
