<?php

namespace App\Domain\Product\Repository;


use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Domain\Common\EntityCollection;
use App\Domain\Product\Entity\Product;

interface ProductRepository
{
    public function save(Product $product): void;
    public function getAllWithFilters(ProductCriteria $criteria): EntityCollection;
    public function getById(string $productId): Product;
}