<?php

namespace App\Service\Auth;

use App\Entity\User;
use App\Exception\InvalidLoginCredentialsException;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginService
{
    /**
     * @var JWTTokenManagerInterface
     */
    private JWTTokenManagerInterface $jwtManager;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * @param JWTTokenManagerInterface $jwtManager
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->jwtManager = $jwtManager;
        $this->userRepository = $userRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param User|null $user
     * @param string|null $email
     * @param string|null $password
     * @return User
     * @throws InvalidLoginCredentialsException
     */
    public function handle(User $user = null, string $email = null, string $password = null): User
    {
        if (null === $user) {
            if (null === $email || null === $password) {
                throw new InvalidLoginCredentialsException();
            }

            $user = $this->userRepository->findOneBy([
                'email' => $email
            ]);

            if (null === $user) {
                throw new InvalidLoginCredentialsException();
            }

            if (false === $this->userPasswordEncoder->isPasswordValid($user, $password)) {
                throw new InvalidLoginCredentialsException();
            }
        }

        $authToken = $this->jwtManager->create($user);

        $user->setAuthToken($authToken);

        return $user;
    }
}