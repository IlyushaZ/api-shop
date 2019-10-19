<?php

namespace App\Domain\User\Repository;


interface UserRepositoryRead
{
    public function checkIfUserWithEmailExists(string $email): bool;

    public function checkIfUserWithLoginExists(string $login): bool;

    public function checkIfUserWithPhoneNumberExists(string $phone): bool;
}