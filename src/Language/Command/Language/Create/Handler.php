<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Create;

use App\Language\Model\Language\Language;
use App\Language\Model\Language\Name;
use App\Language\Service\Language\Creator;

/**
 * Handler.
 */
class Handler
{
    private Creator $creator;

    public function __construct(Creator $creator)
    {
        $this->creator = $creator;
    }

    public function handle(Command $command): Language
    {
        return $this->creator->create(
            new Name($command->getName())
        );
    }
}
