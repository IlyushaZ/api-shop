<?php

namespace App\Domain\Authentication\Exception;


use App\Domain\Common\Exception\BaseDomainException;

class AuthenticationException extends BaseDomainException
{
    public static function invalidAuthData(): self
    {
        return new self('Given combination of login and password is invalid.', 400);
    }
}