<?php

namespace App\Domain\User\Entity;

class Admin extends User
{
    public function __construct(Auth $auth, Contact $contact)
    {
        parent::__construct($auth, $contact);
    }
}