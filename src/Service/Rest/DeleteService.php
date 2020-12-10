<?php

namespace App\Service\Rest;

use App\Entity\AbstractEntity;
use App\Exception\MissingRepositoryException;
use App\Exception\ValidationException;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteService extends RestService
{
    /**
     * @param array $findBy
     * @return AbstractEntity
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(array $findBy): AbstractEntity
    {
        if (null === $this->repository) {
            throw new MissingRepositoryException();
        }

        /** @var AbstractEntity $entity */
        $entity = $this->repository->findOneBy(array_merge($findBy, ['deletedAt' => null]));

        if (null === $entity) {
            throw new NotFoundHttpException();
        }

        if (method_exists($entity, 'setDeletedAt')) {
            $entity->setDeletedAt(new DateTime());
        } else {
            $this->repository->remove($entity);
        }

        $this->save($entity);

        return $entity;
    }
}