<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use App\Service\Traits\CaseConverter;
use DateTime;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class RestController extends AbstractController
{
    use CaseConverter;

    abstract protected function getEntityClass(): string;

    protected function response($data, array $meta = [], $errors = []): JsonResponse
    {
        return $this->json([
            'data' => $this->serialize($data),
            'meta' => $meta,
            'errors' => $errors
        ]);
    }

    protected function serialize($data): ?array
    {
        if ($data instanceof AbstractEntity) {
            return $data->toArray();
        }

        if (is_array($data)) {
            return array_map(function (AbstractEntity $entity) {
                return $entity->toArray();
            }, $data);
        }

        return $data;
    }

    protected function errorResponse(string $errors): JsonResponse
    {
        return $this->response(null, [], $errors);
    }

    protected function getRepository(): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository($this->getEntityClass());
    }

    protected function fetchAll(): array
    {
        return $this->getRepository()->findBy(['deletedAt' => null]);
    }

    protected function decodeRequestData(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }

    protected function createEntity(Request $request): AbstractEntity
    {
        $entityClass = $this->getEntityClass();
        /** @var AbstractEntity $entity */
        $entity = new $entityClass;
        $requestData = $this->decodeRequestData($request);

        $this->fillEntityFields($entity, $requestData);

        return $entity;
    }

    protected function updateEntity(AbstractEntity $entity, Request $request): AbstractEntity
    {
        $requestData = $this->decodeRequestData($request);

        $this->fillEntityFields($entity, $requestData);

        return $entity;
    }

    protected function save(AbstractEntity $entity): AbstractEntity
    {
        $this->getDoctrine()->getManager()->persist($entity);
        $this->getDoctrine()->getManager()->flush();

        return $entity;
    }

    protected function delete(int $id): AbstractEntity
    {
        $entity = $this->getEntity(['id' => $id]);
        $entity->setDeletedAt(new DateTime());

        $this->save($entity);

        return $entity;
    }

    protected function getEntity(array $findBy): AbstractEntity
    {
        /** @var AbstractEntity $entity */
        $entity = $this->getRepository()->findOneBy(
            array_unique(
                array_merge(
                    $findBy,
                    ['deletedAt' => null]
                )
            )
        );

        if (null === $entity) {
            throw new NotFoundHttpException('Object with the given criteria could not be found.');
        }

        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @param array $requestData
     */
    protected function fillEntityFields(AbstractEntity $entity, array $requestData): void
    {
        foreach ($entity->getWriteableFields() as $fieldName) {
            $entitySetter = 'set' . ucfirst($this->toCamelCase($fieldName));

            if (method_exists($entity, $entitySetter) && isset($requestData[$fieldName])) {
                $entity->$entitySetter($requestData[$fieldName]);
            }
        }
    }
}