<?php

namespace App\Infrastructure\Doctrine\Service\User;


use App\Application\Cqs\Auth\Dto\AuthenticationDto;
use App\Domain\Authentication\Exception\AuthenticationException;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryRead;
use App\Domain\Authentication\Service\AuthenticationService;
use App\Infrastructure\Helper\HashHelper;

class AuthenticationServiceImpl implements AuthenticationService
{
    private $userRepositoryRead;

    public function __construct(UserRepositoryRead $userRepositoryRead)
    {
        $this->userRepositoryRead = $userRepositoryRead;
    }

    public function authenticate(AuthenticationDto $dto): User
    {
        $user = $this->userRepositoryRead->findByLogin($dto->login);

        if (!HashHelper::isPasswordValid($dto->password, $user->getAuth()->getPassword())) {
            throw AuthenticationException::invalidAuthData();
        }

        return $user;
    }
}