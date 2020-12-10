<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
    private $name;

    /**
     * @var Location
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Location", inversedBy="venue")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="RESTRICT")
     */
    private $location;

    public function getWriteableFields(): array
    {
        return ['name', 'location'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'name', 'location'];
    }
}