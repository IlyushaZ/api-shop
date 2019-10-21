<?php

namespace App\Application\Cqs\Auth\Command;


use App\Application\Cqs\Auth\Dto\AuthenticationDto;
use App\Application\Cqs\Auth\Output\AuthenticationOutput;
use App\Application\Security\SecurityAdapter;
use App\Domain\Authentication\Exception\AuthenticationException;
use App\Domain\Authentication\Service\AuthenticationService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthenticateUserCommand
{
    private $tokenManager;
    private $authenticationService;

    public function __construct(JWTTokenManagerInterface $tokenManager, AuthenticationService $authenticationService)
    {
        $this->tokenManager = $tokenManager;
        $this->authenticationService = $authenticationService;
    }

    public function execute(AuthenticationDto $dto): AuthenticationOutput
    {
        try {
            $user = $this->authenticationService->authenticate($dto);
        } catch (AuthenticationException $exception) {
            throw new \App\Application\Cqs\Auth\Exception\AuthenticationException($exception->getMessage());
        }

        $token = $this->tokenManager->create(new SecurityAdapter($user));

        return AuthenticationOutput::from($token, $user->getType());
    }
}