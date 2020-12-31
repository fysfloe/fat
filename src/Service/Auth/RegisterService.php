<?php

namespace App\Service\Auth;

use App\Entity\User;
use App\Exception\MissingRepositoryException;
use App\Exception\UserAlreadyExistsException;
use App\Exception\ValidationException;
use App\Exception\WrongDateTimeFormatException;
use App\Repository\UserRepository;
use App\Service\Rest\RestService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use ReflectionException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService extends RestService
{
    /**
     * @var LoginService
     */
    private $loginService;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @param LoginService $loginService
     * @param Security $security
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(
        LoginService $loginService,
        Security $security,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        parent::__construct($security, $em, $validator);
        $this->loginService = $loginService;
        $this->repository = $userRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param array $userData
     * @return User
     * @throws UserAlreadyExistsException
     * @throws MissingRepositoryException
     * @throws ValidationException
     * @throws WrongDateTimeFormatException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function handle(array $userData): User
    {
        $existingUser = $this->repository->findOneBy([
            'email' => $userData['email']
        ]);

        if (null !== $existingUser) {
            throw new UserAlreadyExistsException();
        }

        $user = new User();
        $this->fillEntityFields($user, $userData);

        $this->validate($user);

        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $userData['password']));

        $this->save($user);

        $this->loginService->handle($user);

        return $user;
    }
}