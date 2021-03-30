<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Create;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Command.
 */
class Command
{
    /**
     * @Assert\NotBlank()
     */
    private string $name;

    private int $newField;

    /**
     * Command constructor.
     * @param string $name
     * @param int $newField
     */
    public function __construct(string $name, int $newField)
    {
        $this->name = $name;
        $this->newField = $newField;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getNewField(): int
    {
        return $this->newField;
    }

}
