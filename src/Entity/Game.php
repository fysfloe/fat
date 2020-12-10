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
     */
    protected DateTime $date;

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
     * @var Venue|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Venue")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id", onDelete="RESTRICT")
     */
    protected ?Venue $venue = null;

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

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Game
     */
    public function setDate(DateTime $date): Game
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Game
     */
    public function setDescription(string $description): Game
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return User
     */
    public function getOrganizer(): User
    {
        return $this->organizer;
    }

    /**
     * @param User $organizer
     * @return Game
     */
    public function setOrganizer(User $organizer): Game
    {
        $this->organizer = $organizer;
        return $this;
    }

    /**
     * @return Venue
     */
    public function getVenue(): ?Venue
    {
        return $this->venue;
    }

    /**
     * @param Venue $venue
     * @return Game
     */
    public function setVenue(?Venue $venue): Game
    {
        $this->venue = $venue;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @param bool $private
     * @return Game
     */
    public function setPrivate(bool $private): Game
    {
        $this->private = $private;
        return $this;
    }

    public function getWriteableFields(): array
    {
        return ['date', 'name', 'venue', 'private'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'name', 'date', 'venue', 'private'];
    }
}