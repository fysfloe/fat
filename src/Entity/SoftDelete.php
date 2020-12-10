<?php

namespace App\Entity;

use DateTime;

trait SoftDelete
{
    /**
     * @var DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $deletedAt;

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     * @return AbstractEntity
     */
    public function setDeletedAt(?DateTime $deletedAt): AbstractEntity
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}