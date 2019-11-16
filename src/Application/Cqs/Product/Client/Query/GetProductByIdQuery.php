<?php

namespace App\Application\Cqs\Product\Client\Query;


use App\Application\Cqs\Product\Client\Output\ProductClientOutput;
use App\Application\Cqs\Product\Common\Query\ProductQuery;

class GetProductByIdQuery extends ProductQuery
{
    public function execute(string $queryId): ProductClientOutput
    {
        $product = $this->productRepository->getById($queryId);

        return ProductClientOutput::fromEntity($product);
    }
}