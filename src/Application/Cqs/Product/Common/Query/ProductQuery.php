<?php

namespace App\Application\Cqs\Product\Common\Query;


use App\Domain\Product\Repository\ProductRepository;

abstract class ProductQuery
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}