<?php

namespace App\Controller;

use App\Entity\FootballGame;
use App\Exception\MissingRepositoryException;
use App\Exception\WrongRepositoryException;
use App\Service\FootballGame\CreateFootballGameService;
use App\Service\Rest\CreateService;
use App\Service\Rest\DeleteService;
use App\Service\Rest\UpdateService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/football_game")
 */
class FootballGameController extends RestController
{
    /**
     * @Route("", methods={"GET"})
     *
     * @return JsonResponse
     * @throws WrongRepositoryException
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
     * @param CreateFootballGameService $createService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function createAction(Request $request, CreateFootballGameService $createService): JsonResponse
    {
        return $this->defaultCreateAction($request, $createService);
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

    /**
     * @Route("/{handle}", methods={"PATCH"})
     *
     * @param string $handle
     * @param Request $request
     * @param UpdateService $updateService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function updateAction(string $handle, Request $request, UpdateService $updateService): JsonResponse
    {
        return $this->defaultUpdateAction($handle, $request, $updateService);
    }

    /**
     * @Route("/{handle}", methods={"DELETE"})
     *
     * @param string $handle
     * @param DeleteService $deleteService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function deleteAction(string $handle, DeleteService $deleteService): JsonResponse
    {
        return $this->defaultDeleteAction($handle, $deleteService);
    }

    protected function getEntityClass(): string
    {
        return FootballGame::class;
    }
}