<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class VenueDetails extends AbstractEntity
{
    use BaseEntity;
    use SoftDelete;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected string $ground;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected ?string $groundAddition = null;

    /**
     * @var array|null
     *
     * @ORM\Column(type="array", nullable=true)
     */
    protected ?array $additions = [];

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected ?string $description;

    /**
     * @return string
     */
    public function getGround(): string
    {
        return $this->ground;
    }

    /**
     * @param string $ground
     * @return VenueDetails
     */
    public function setGround(string $ground): VenueDetails
    {
        $this->ground = $ground;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroundAddition(): ?string
    {
        return $this->groundAddition;
    }

    /**
     * @param string|null $groundAddition
     * @return VenueDetails
     */
    public function setGroundAddition(?string $groundAddition): VenueDetails
    {
        $this->groundAddition = $groundAddition;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAdditions(): ?array
    {
        return $this->additions;
    }

    /**
     * @param array|null $additions
     * @return VenueDetails
     */
    public function setAdditions(?array $additions): VenueDetails
    {
        $this->additions = $additions;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return VenueDetails
     */
    public function setDescription(?string $description): VenueDetails
    {
        $this->description = $description;
        return $this;
    }

    public function getWriteableFields(): array
    {
        return ['ground', 'groundAddition', 'additions', 'description'];
    }

    public function getReadableFields(): array
    {
        return ['id', 'ground', 'groundAddition', 'additions', 'description'];
    }
}