<?php

namespace App\Service\Rest;

use App\Entity\AbstractEntity;
use App\Exception\MissingRepositoryException;
use App\Exception\ValidationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UpdateService extends RestService
{
    /**
     * @param array $findBy
     * @param array $requestData
     * @return AbstractEntity
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ValidationException
     */
    public function handle(array $findBy, array $requestData): AbstractEntity
    {
        if (null === $this->repository) {
            throw new MissingRepositoryException();
        }

        /** @var AbstractEntity $entity */
        $entity = $this->repository->findOneBy($findBy);

        $this->fillEntityFields($entity, $requestData);

        $this->validate($entity);
        $this->save($entity);

        return $entity;
    }
}