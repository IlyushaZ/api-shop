<?php

namespace App\Domain\User\Exception;


use App\Domain\Common\Exception\CustomEntityNotFoundException;

class UserNotFoundException extends CustomEntityNotFoundException
{
    public function getEntityName(): string
    {
        return 'User';
    }
}