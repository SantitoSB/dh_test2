<?php

declare(strict_types=1);

namespace App\Language\Service\Language;

use App\Application\ValueObject\Uuid;
use App\Data\Flusher;
use App\Language\Model\Language\Code;
use App\Language\Model\Language\Language;
use App\Language\Model\Language\Name;
use App\Language\Model\Language\NewField;
use App\Language\Repository\LanguageRepository;

/**
 * Updater.
 */
class Updater
{
    private Flusher $flusher;

    public function __construct(Flusher $flusher)
    {
        $this->flusher = $flusher;
    }

    public function update(
        Language $language,
        ?Name $name,
        ?NewField $newField
    ): Language {

        $language->update($name, $newField);

        $this->flusher->flush();

        return $language;
    }
}
