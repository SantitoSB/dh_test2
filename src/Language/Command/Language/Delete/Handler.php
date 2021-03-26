<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Delete;

use App\Language\Service\Language\Deleter;

/**
 * Handler.
 */
class Handler
{
    private Deleter $deleter;

    public function __construct(Deleter $deleter)
    {
        $this->deleter = $deleter;
    }

    public function handle(Command $command): array
    {
        $this->deleter->delete($command->getId());
        return  ['message' => 'Язык удален'];
    }
}
