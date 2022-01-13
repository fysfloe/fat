<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\WrongRepositoryException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends RestController
{
    /**
     * @Route("/autocomplete", methods={"GET"})
     *
     * @param Request $request
     * @return JsonResponse
     * @throws WrongRepositoryException
     */
    public function autocompleteAction(Request $request): JsonResponse
    {
        return $this->autocompleteResponse(
            $this->getRepository()->autocomplete($request->get('autocomplete'))
        );
    }

    /**
     * @Route("/{handle}", methods={"GET"})
     *
     * @param string $handle
     * @return JsonResponse
     */
    public function getAction(string $handle): JsonResponse
    {
        return $this->response($this->getEntity(['handle' => $handle]));
    }

    protected function getEntityClass(): string
    {
        return User::class;
    }
}