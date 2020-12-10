<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

abstract class Game extends AbstractEntity
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected string $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    protected string $date;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected string $description;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="organizer", referencedColumnName="id", onDelete="RESTRICT")
     */
    protected User $organizer;

    /**
     * @var Venue
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Venue")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id", onDelete="RESTRICT")
     */
    protected Venue $venue;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default"=false}, nullable=false)
     */
    protected bool $private = false;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Game
     */
    public function setName(string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    public function getWriteableFields(): array
    {
        return ['name'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'name'];
    }
}