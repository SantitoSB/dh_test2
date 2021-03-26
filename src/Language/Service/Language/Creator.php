<?php

declare(strict_types=1);

namespace App\Language\Service\Language;

use App\Application\ValueObject\Uuid;
use App\Data\Flusher;
use App\Language\Model\Language\Code;
use App\Language\Model\Language\Language;
use App\Language\Model\Language\Name;
use App\Language\Repository\LanguageRepository;

/**
 * Creator.
 */
class Creator
{
    private LanguageRepository $languageRepository;
    private Flusher $flusher;

    public function __construct(LanguageRepository $languageRepository, Flusher $flusher)
    {
        $this->languageRepository = $languageRepository;
        $this->flusher = $flusher;
    }

    public function create(
        Name $name
    ): Language {
        $language = new Language(
            1,
            $name
        );

        $this->languageRepository->add($language);
        $this->flusher->flush();

        return $language;
    }
}
