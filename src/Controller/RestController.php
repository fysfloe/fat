<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use App\Service\Traits\CaseConverter;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class RestController extends AbstractController
{
    use CaseConverter;

    abstract protected function getEntityClass(): string;

    protected function response($data, array $meta = [], array $errors = []): JsonResponse
    {
        return $this->json([
            'data' => $this->serialize($data),
            'meta' => $meta,
            'errors' => $errors
        ]);
    }

    protected function serialize($data): array
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

    protected function errorResponse(array $errors): JsonResponse
    {
        return $this->response(null, [], $errors);
    }

    protected function getRepository(): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository($this->getEntityClass());
    }

    protected function fetchAll(): array
    {
        return $this->getRepository()->findAll();
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

        foreach ($entity->getWriteableFields() as $fieldName) {
            $entitySetter = 'set' . ucfirst($this->toCamelCase($fieldName));

            if (method_exists($entity, $entitySetter) && isset($requestData[$fieldName])) {
                $entity->$entitySetter($requestData[$fieldName]);
            }
        }

        return $entity;
    }

    protected function save(AbstractEntity $entity): AbstractEntity
    {
        $this->getDoctrine()->getManager()->persist($entity);
        $this->getDoctrine()->getManager()->flush();

        return $entity;
    }
}