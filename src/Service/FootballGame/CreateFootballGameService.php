<?php

namespace App\Service\FootballGame;

use App\Entity\AbstractEntity;
use App\Entity\FootballGame;
use App\Exception\ValidationException;
use App\Service\Rest\CreateService;

class CreateFootballGameService extends CreateService
{
    protected function validate(AbstractEntity $entity): AbstractEntity
    {
        /** @var FootballGame $entity */
        $entity = parent::validate($entity);

        if (null === $entity->getVenue() && null === $entity->getLocation()) {
            throw new ValidationException(['Either venue or location have to be set.']);
        }

        if (null !== $entity->getVenue()) {
            $entity->setLocation(null);
        }

        return $entity;
    }
}