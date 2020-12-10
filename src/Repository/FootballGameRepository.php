<?php

namespace App\Repository;

use App\Entity\FootballGame;
use Doctrine\Persistence\ManagerRegistry;

class FootballGameRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FootballGame::class);
    }
}
