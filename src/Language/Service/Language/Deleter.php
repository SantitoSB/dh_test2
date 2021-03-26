<?php

declare(strict_types=1);

namespace App\Language\Service\Language;

use App\Data\Flusher;
use App\Language\Repository\LanguageRepository;

/**
 * Deleter.
 */
class Deleter
{
    private Flusher $flusher;
    private LanguageRepository $languageRepository;

    public function __construct(Flusher $flusher, LanguageRepository $languageRepository)
    {
        $this->flusher = $flusher;
        $this->languageRepository = $languageRepository;
    }

    public function delete(
        int $id
    ): void {

        $this->languageRepository->delete($id);

        $this->flusher->flush();
    }
}
