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

    protected function getEntityClass(): string
    {
        return Game::class;
    }
}