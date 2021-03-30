<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Update;

/**
 * Command.
 */
class Command
{
    private int $id;
    private string $name;
    private int $newField;

    /**
     * Command constructor.
     * @param int $id
     * @param string $name
     * @param int $newField
     */
    public function __construct(int $id, string $name, int $newField)
    {
        $this->id = $id;
        $this->name = $name;
        $this->newField = $newField;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getNewField() : int
    {
        return $this->newField;
    }

}
