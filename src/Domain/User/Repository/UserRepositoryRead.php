<?php

namespace App\Domain\User\Repository;


use App\Domain\User\Entity\User;

interface UserRepositoryRead
{
    public function findByLogin(string $login): User;

    public function checkIfUserWithEmailExists(string $email): bool;

    public function checkIfUserWithLoginExists(string $login): bool;

    public function checkIfUserWithPhoneNumberExists(string $phone): bool;
}