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
     *
     * @ORM\Column(type="language_language_new_field")
     */
    private NewField $newField;

    /**
     * Language constructor.
     * @param int $id
     * @param Name $name
     * @param NewField $newField
     */
    public function __construct(int $id, Name $name, NewField $newField)
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
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return NewField
     */
    public function getNewField() : NewField
    {
        return $this->newField;
    }

    public function update(?Name $name, ?NewField $newField)
    {
        if ($name) {
            $this->name = $name;
        }

        if($newField)
        {
            $this->newField = $newField;
        }

    }
}
