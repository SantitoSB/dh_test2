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

    /**
     * Command constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
