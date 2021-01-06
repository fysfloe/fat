<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use App\Exception\MissingRepositoryException;
use App\Exception\ValidationException;
use App\Exception\WrongRepositoryException;
use App\Repository\BaseRepository;
use App\Service\Rest\CreateService;
use App\Service\Rest\DeleteService;
use App\Service\Rest\UpdateService;
use App\Service\Traits\CaseConverter;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class RestController extends AbstractController
{
    use CaseConverter;

    abstract protected function getEntityClass(): string;

    /**
     * @return BaseRepository
     * @throws WrongRepositoryException
     */
    protected function getRepository(): BaseRepository
    {
        $repository = $this->getDoctrine()->getManager()->getRepository($this->getEntityClass());

        if (!$repository instanceof BaseRepository) {
            throw new WrongRepositoryException();
        }

        return $repository;
    }

    /**
     * @param Request $request
     * @param CreateService $createService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    protected function defaultCreateAction(Request $request, CreateService $createService): JsonResponse
    {
        $createService->setRepository($this->getRepository());

        try {
            return $this->response(
                $createService->handle($this->getEntityClass(), $this->decodeRequestData($request)),
                [],
                [],
                Response::HTTP_CREATED
            );
        } catch (ValidationException $e) {
            return $this->errorResponse((string)$e->getErrors());
        }
    }

    /**
     * @param string $handle
     * @param Request $request
     * @param UpdateService $updateService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    protected function defaultUpdateAction(string $handle, Request $request, UpdateService $updateService): JsonResponse
    {
        $updateService->setRepository($this->getRepository());

        try {
            return $this->response(
                $updateService->handle(['handle' => $handle], $this->decodeRequestData($request))
            );
        } catch (ValidationException $e) {
            return $this->errorResponse((string)$e->getErrors());
        }
    }

    /**
     * @param int $id
     * @param DeleteService $deleteService
     * @return JsonResponse
     * @throws MissingRepositoryException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws WrongRepositoryException
     */
    protected function defaultDeleteAction(string $handle, DeleteService $deleteService): JsonResponse
    {
        $deleteService->setRepository($this->getRepository());

        return $this->response(
            $deleteService->handle(['handle' => $handle])
        );
    }

    /**
     * @return array
     * @throws WrongRepositoryException
     */
    protected function fetchAll(): array
    {
        return $this->getRepository()->findBy(['deletedAt' => null]);
    }

    protected function decodeRequestData(Request $request): array
    {
        return json_decode($request->getContent(), true);
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


}