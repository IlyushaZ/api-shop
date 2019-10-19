<?php

namespace App\Domain\User\Service;


use App\Domain\User\Entity\User;

interface UserService
{
    public function register(User $user): void;
}