<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Update;

use App\Language\Model\Language\Language;
use App\Language\Model\Language\Name;
use App\Language\Repository\LanguageRepository;
use App\Language\Service\Language\Updater;

/**
 * Handler.
 */
class Handler
{
    private Updater $updater;
    private LanguageRepository $languageRepository;

    public function __construct(Updater $updater, LanguageRepository $languageRepository)
    {
        $this->updater = $updater;
        $this->languageRepository = $languageRepository;
    }

    public function handle(Command $command): Language
    {
        $language = $this->languageRepository->get($command->getId());

        return $this->updater->update(
            $language,
            new Name($command->getName())
        );
    }
}
