<?php

namespace App\Domain\Authentication\Service;


use App\Application\Cqs\Auth\Dto\AuthenticationDto;
use App\Domain\User\Entity\User;

interface AuthenticationService
{
    public function authenticate(AuthenticationDto $dto): User;
}