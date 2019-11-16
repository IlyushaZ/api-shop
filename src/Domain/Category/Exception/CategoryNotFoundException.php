<?php

namespace App\Domain\Category\Exception;


use App\Domain\Common\Exception\CustomEntityNotFoundException;

class CategoryNotFoundException extends CustomEntityNotFoundException
{
    public function getEntityName(): string
    {
        return 'Category';
    }
}