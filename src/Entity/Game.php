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
    protected DateTime $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    protected DateTime $endDate;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected ?string $description = null;

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
     * @var Location|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected ?Location $location = null;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default"=false}, nullable=false)
     */
    protected bool $private = false;

    /**
     * @var VenueDetails
     *
     * @ORM\OneToOne(targetEntity="VenueDetails")
     * @ORM\JoinColumn(name="venue_details_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected VenueDetails $venueDetails;

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
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     * @return Game
     */
    public function setStartDate(DateTime $startDate): Game
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     * @return Game
     */
    public function setEndDate(DateTime $endDate): Game
    {
        $this->endDate = $endDate;
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
     * @return Venue|null
     */
    public function getVenue(): ?Venue
    {
        return $this->venue;
    }

    /**
     * @param Venue|null $venue
     * @return Game
     */
    public function setVenue(?Venue $venue): Game
    {
        $this->venue = $venue;
        return $this;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location|null $location
     * @return Game
     */
    public function setLocation(?Location $location): Game
    {
        $this->location = $location;
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

    /**
     * @return VenueDetails
     */
    public function getVenueDetails(): VenueDetails
    {
        return $this->venueDetails;
    }

    /**
     * @param VenueDetails $venueDetails
     * @return Game
     */
    public function setVenueDetails(VenueDetails $venueDetails): Game
    {
        $this->venueDetails = $venueDetails;
        return $this;
    }

    public function getWriteableFields(): array
    {
        return ['startDate', 'endDate', 'name', 'venue', 'location', 'private', 'venueDetails'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'name', 'startDate', 'endDate', 'venue', 'location', 'private', 'venueDetails'];
    }
}