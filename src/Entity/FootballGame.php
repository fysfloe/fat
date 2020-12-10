<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class FootballGame extends Game
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private int $playersPerSide;

    public function getWriteableFields(): array
    {
        return array_merge(
            parent::getWriteableFields(),
            ['playersPerSide']
        );
    }

    public function getReadableFields(): array
    {
        return array_merge(
            parent::getReadableFields(),
            ['playersPerSide']
        );
    }
}