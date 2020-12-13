<?php

namespace App\Service\Rest;

use App\Entity\AbstractEntity;
use App\Entity\User;
use App\Exception\MissingRepositoryException;
use App\Exception\ValidationException;
use App\Exception\WrongDateTimeFormatException;
use App\Repository\BaseRepository;
use App\Service\Traits\CaseConverter;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class RestService
{
    use CaseConverter;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    /**
     * @var BaseRepository
     */
    protected $repository;
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(Security $security, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->user = $security->getUser();
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @param AbstractEntity $entity
     * @param array $requestData
     * @return AbstractEntity
     * @throws ReflectionException
     * @throws WrongDateTimeFormatException
     */
    protected function fillEntityFields(AbstractEntity $entity, array $requestData): AbstractEntity
    {
        foreach ($entity->getWriteableFields() as $fieldName) {
            $value = $requestData[$this->toSnakeCase($fieldName)];

            $reflectionProperty = new ReflectionProperty(get_class($entity), $fieldName);
            $fieldType = $reflectionProperty->getType()->getName();

            try {
                $reflectionClass = new ReflectionClass($fieldType);
            } catch (Exception $e) {
                $reflectionClass = null;
            }

            if (DateTime::class === $fieldType) {
                try {
                    $value = new DateTime($value);
                } catch (Exception $e) {
                    throw new WrongDateTimeFormatException([sprintf('Wrong DateTime format given: %s', $value)]);
                }
            } else if (null !== $reflectionClass) {
                $entityRepository = $this->em->getRepository($reflectionClass->getName());

                if (is_int($value)) {
                    // We expect this to be an id. Let's find the entity.
                    $value = $this->findEntity($entityRepository, $value, $reflectionClass);
                }

                if (is_array($value)) {
                    if (array_key_exists('id', $value)) {
                        $value = $this->findEntity($entityRepository, $value['id'], $reflectionClass);
                    } else {
                        $newEntity = new $fieldType;
                        $value = $this->fillEntityFields($newEntity, $value);
                        $this->em->persist($value);
                    }
                }
            }

            $entitySetter = 'set' . ucfirst($this->toCamelCase($fieldName));

            if (method_exists($entity, $entitySetter) && isset($requestData[$this->toSnakeCase($fieldName)])) {
                $entity->$entitySetter($value);
            }
        }

        if (null !== $this->user && method_exists($entity, 'setCreatedBy')) {
            $entity->setCreatedBy($this->user);
        }

        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function save(AbstractEntity $entity): AbstractEntity
    {
        if (null === $this->repository) {
            throw new MissingRepositoryException();
        }

        return $this->repository->save($entity);
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ValidationException
     */
    protected function validate(AbstractEntity $entity): AbstractEntity
    {
        $errors = $this->validator->validate($entity);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        return $entity;
    }

    /**
     * @param BaseRepository $repository
     * @return RestService
     */
    public function setRepository(BaseRepository $repository): RestService
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @param $entityRepository
     * @param int $value
     * @param ReflectionClass|null $reflectionClass
     * @return AbstractEntity
     */
    protected function findEntity($entityRepository, int $value, ?ReflectionClass $reflectionClass): AbstractEntity
    {
        $value = $entityRepository->findOneBy(['deletedAt' => null, 'id' => $value]);

        if (null === $value) {
            throw new NotFoundHttpException(sprintf('Entity of type %s with id %s could not be found.', $reflectionClass->getName(), $value));
        }

        return $value;
    }
}