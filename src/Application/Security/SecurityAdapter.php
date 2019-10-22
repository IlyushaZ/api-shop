<?php

namespace App\Application\Security;


use App\Domain\User\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityAdapter implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function unwrapUser(): User
    {
        return $this->user;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->user->getAuth()->getPassword();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->user->getAuth()->getLogin();
    }

    public function getLogin(): string
    {
        return $this->user->getAuth()->getLogin();
    }

    public function eraseCredentials()
    {
    }
}