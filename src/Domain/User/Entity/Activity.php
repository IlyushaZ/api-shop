<?php

namespace App\Domain\User\Entity;

use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\IsBlocked;
use App\Domain\Common\Traits\IsConfirmed;
use App\Domain\Common\Traits\UpdatedAt;

class Activity
{
    use CreatedAt, UpdatedAt, IsConfirmed, IsBlocked;

    public function __construct()
    {
        $this->onCreated();
    }
}