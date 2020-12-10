<?php

namespace App\Repository;

use App\Entity\AbstractEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(AbstractEntity $entity): AbstractEntity
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(AbstractEntity $entity): AbstractEntity
    {
        $this->_em->remove($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ORMException
     */
    public function persist(AbstractEntity $entity): AbstractEntity
    {
        $this->_em->persist($entity);

        return $entity;
    }
}