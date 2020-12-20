<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FootballGameRepository")
 */
class FootballGame extends Game
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $playersPerSide = null;

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

    /**
     * @return int|null
     */
    public function getPlayersPerSide(): ?int
    {
        return $this->playersPerSide;
    }

    /**
     * @param int|null $playersPerSide
     * @return FootballGame
     */
    public function setPlayersPerSide(?int $playersPerSide): FootballGame
    {
        $this->playersPerSide = $playersPerSide;
        return $this;
    }
}