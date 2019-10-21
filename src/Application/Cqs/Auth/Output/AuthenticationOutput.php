<?php

namespace App\Application\Cqs\Auth\Output;


class AuthenticationOutput
{
    /** @var string */
    public $token;

    /** @var string */
    public $userType;

    public static function from(string $token, string $userType): self
    {
        $self = new self();

        $self->token = $token;
        $self->userType = $userType;

        return $self;
    }
}