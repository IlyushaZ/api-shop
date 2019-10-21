<?php

namespace App\Application\Http\Common;
use App\Application\Cqs\Auth\Command\AuthenticateUserCommand;
use App\Application\Cqs\Auth\Dto\AuthenticationDto;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth")
 */
class AuthController
{
    /**
     * @Route("/login", methods={"POST"})
     */
    public function login(AuthenticationDto $dto, AuthenticateUserCommand $command)
    {
        return $command->execute($dto);
    }
}