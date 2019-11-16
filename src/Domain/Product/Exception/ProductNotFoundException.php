<?php

namespace App\Domain\Product\Exception;


use App\Domain\Common\Exception\CustomEntityNotFoundException;

class ProductNotFoundException extends CustomEntityNotFoundException
{
    public function getEntityName(): string
    {
        return 'Product';
    }
}