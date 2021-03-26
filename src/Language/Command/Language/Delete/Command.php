<?php

declare(strict_types=1);

namespace App\Language\Command\Language\Delete;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Command.
 */
class Command
{
    /**
     * @Assert\NotBlank()
     */
    private int $id;

    /**
     * Command constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}
