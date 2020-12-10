<?php

namespace App\Repository;

use App\Entity\FootballGame;
use App\Entity\Venue;
use Doctrine\Persistence\ManagerRegistry;

class VenueRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Venue::class);
    }
}
