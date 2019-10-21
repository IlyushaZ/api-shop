<?php

namespace App\Application\Cqs\Auth\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class AuthenticationDto
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $login;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $password;
}