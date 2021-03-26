<?php
declare(strict_types=1);

namespace App\Language\Model\Language;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="language")
 * @ORM\Entity()
 */
class Language
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="language_language_name")
     */
    private Name $name;

    /**
     * Language constructor.
     * @param int $id
     * @param Name $name
     */
    public function __construct(int $id, Name $name)
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
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    public function update(?Name $name)
    {
        if ($name) {
            $this->name = $name;
        }
    }
}
