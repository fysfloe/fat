<?php

namespace App\Controller;

use App\Entity\FootballGame;
use App\Exception\MissingRepositoryException;
use App\Exception\WrongRepositoryException;
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
     * @param CreateService $createService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function createAction(Request $request, CreateService $createService): JsonResponse
    {
        return $this->defaultCreateAction($request, $createService);
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
     * @param UpdateService $updateService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function updateAction(int $id, Request $request, UpdateService $updateService): JsonResponse
    {
        return $this->defaultUpdateAction($id, $request, $updateService);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     *
     * @param int $id
     * @param DeleteService $deleteService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    public function deleteAction(int $id, DeleteService $deleteService): JsonResponse
    {
        return $this->defaultDeleteAction($id, $deleteService);
    }

    protected function getEntityClass(): string
    {
        return FootballGame::class;
    }
}