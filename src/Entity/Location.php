<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Location extends AbstractEntity
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private string $street;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private string $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private string $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2)
     * @Assert\Country()
     * @Assert\NotBlank()
     */
    private string $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private string $placeId;

    /**
     * @var Venue
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Venue", mappedBy="location")
     */
    private Venue $venue;

    public function getWriteableFields(): array
    {
        return ['street', 'zipCode', 'city', 'country', 'placeId'];
    }

    public function getReadableFields(): array
    {
        return ['street', 'zipCode', 'city', 'country', 'placeId'];
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Location
     */
    public function setStreet(string $street): Location
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Location
     */
    public function setZipCode(string $zipCode): Location
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Location
     */
    public function setCountry(string $country): Location
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     * @return Location
     */
    public function setPlaceId(string $placeId): Location
    {
        $this->placeId = $placeId;
        return $this;
    }
}
