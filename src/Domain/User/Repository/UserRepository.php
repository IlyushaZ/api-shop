<?php

namespace App\Domain\User\Repository;


use App\Domain\User\Entity\User;

interface UserRepository extends UserRepositoryRead
{
    public function save(User $user): void;
}