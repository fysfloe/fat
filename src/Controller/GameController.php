<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/game")
 */
class GameController extends RestController
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
        $game = $this->createEntity($request);

        $errors = $validator->validate($game);

        if (count($errors) > 0) {
            return $this->errorResponse((array)$errors);
        }

        $this->save($game);

        return $this->response($game);
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
        $game = $this->getEntity(['id' => $id]);

        $game = $this->updateEntity($game, $request);

        $errors = $validator->validate($game);

        if (count($errors) > 0) {
            return $this->errorResponse((string)$errors);
        }

        $this->save($game);

        return $this->response($game);
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
        return Game::class;
    }
}