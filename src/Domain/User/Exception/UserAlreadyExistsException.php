<?php

namespace App\Domain\User\Exception;


use App\Application\Exception\SerializableException;

class UserAlreadyExistsException extends SerializableException
{
    public static function emailIsAlreadyInUse(string $email): self
    {
        return new self("Email {$email} is already in use!");
    }

    public static function loginIsAlreadyInUse(string $login): self
    {
        return new self("Login {$login} is already in use!");
    }

    public static function phoneNumberIsAlreadyInUse(string $phone): self
    {
        return new self("Phone number {$phone} is already in use!");
    }
}