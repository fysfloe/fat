<?php

namespace App\Controller;

use App\Exception\InvalidLoginCredentialsException;
use App\Exception\MissingRepositoryException;
use App\Exception\UserAlreadyExistsException;
use App\Exception\ValidationException;
use App\Exception\WrongDateTimeFormatException;
use App\Repository\UserRepository;
use App\Service\Auth\LoginService;
use App\Service\Auth\RegisterService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use ReflectionException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth")
 */
class AuthController extends AbstractController
{
    /**
     * @Route("/register", methods={"POST"})
     *
     * @param Request $request
     * @param RegisterService $registerService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ValidationException
     * @throws WrongDateTimeFormatException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function registerAction(Request $request, RegisterService $registerService): JsonResponse
    {
        try {
            $user = $registerService->handle(json_decode($request->getContent(), true));
        } catch (UserAlreadyExistsException $e) {
            return $this->errorResponse('auth.user_already_exists');
        }

        return $this->response($user);
    }

    /**
     * @Route("/current_user", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function currentUserAction(): JsonResponse
    {
        return $this->response($this->getUser());
    }

    /**
     * @Route("/logout", methods={"POST"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
    }
}