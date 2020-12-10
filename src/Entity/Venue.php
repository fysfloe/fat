<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenueRepository")
 */
class Venue extends AbstractEntity
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @var Location
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Location", inversedBy="venue")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="RESTRICT")
     */
    private Location $location;

    public function getWriteableFields(): array
    {
        return ['name', 'location'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'name', 'location'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Venue
     */
    public function setName(string $name): Venue
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Venue
     */
    public function setLocation(Location $location): Venue
    {
        $this->location = $location;
        return $this;
    }
}