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

    /**
     * Command constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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

}
