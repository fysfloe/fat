<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/location")
 */
class LocationController extends RestController
{
    /**
     * @Route("", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function indexAction(): JsonResponse
    {
        return $this->response(
            $this->fetchAll()
        );
    }

    /**
     * @Route("", methods={"POST"})
     *
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function createAction(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $location = $this->createEntity($request);

        $errors = $validator->validate($location);

        if (count($errors) > 0) {
            return $this->errorResponse((string)$errors);
        }

        try {
            $this->save($location);
        } catch (UniqueConstraintViolationException $e) {
            return $this->errorResponse('Place id already exists in the database.');
        }

        return $this->response($location, [], [], Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getAction(int $id): JsonResponse
    {
        return $this->response($this->getEntity(['id' => $id]));
    }

    /**
     * @Route("/{id}", methods={"PATCH"})
     *
     * @param int $id
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function updateAction(int $id, Request $request, ValidatorInterface $validator): JsonResponse
    {
        $location = $this->getEntity(['id' => $id]);

        $location = $this->updateEntity($location, $request);

        $errors = $validator->validate($location);

        if (count($errors) > 0) {
            return $this->errorResponse((string)$errors);
        }

        try {
            $this->save($location);
        } catch (UniqueConstraintViolationException $e) {
            return $this->errorResponse('Place id already exists in the database.');
        }

        return $this->response($location);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteAction(int $id): JsonResponse
    {
        return $this->response($this->delete($id));
    }

    protected function getEntityClass(): string
    {
        return Location::class;
    }
}