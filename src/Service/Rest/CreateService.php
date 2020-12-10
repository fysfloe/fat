<?php

namespace App\Service\Rest;

use App\Entity\AbstractEntity;
use App\Exception\MissingRepositoryException;
use App\Exception\ValidationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class CreateService extends RestService
{
    /**
     * @param string $entityClass
     * @param array $requestData
     * @return AbstractEntity
     * @throws MissingRepositoryException
     * @throws ValidationException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(string $entityClass, array $requestData): AbstractEntity
    {
        /** @var AbstractEntity $entity */
        $entity = new $entityClass;

        $this->fillEntityFields($entity, $requestData);

        $this->validate($entity);
        $this->save($entity);

        return $entity;
    }
}