<?php

namespace App\Application\Cqs\Product\Admin\Command;


use App\Domain\Product\Service\ProductService;

abstract class ProductCommand
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}