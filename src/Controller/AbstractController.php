<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends SymfonyController
{
    protected function response($data, array $meta = [], $errors = [], int $status = Response::HTTP_OK): JsonResponse
    {
        return $this->json([
            'data' => $this->serialize($data),
            'meta' => $meta,
            'errors' => $errors
        ], $status);
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
        return $this->response(null, [], $errors, Response::HTTP_BAD_REQUEST);
    }
}