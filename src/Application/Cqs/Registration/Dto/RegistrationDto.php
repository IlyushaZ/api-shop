<?php

namespace App\Application\Cqs\Registration\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class RegistrationDto
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $login;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=6,
     *     minMessage="Password must be at least {{ limit }} characters long"
     * )
     */
    public $password;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\EqualTo(
     *     propertyPath="password"
     * )
     */
    public $passwordConfirmation;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $phone;
}