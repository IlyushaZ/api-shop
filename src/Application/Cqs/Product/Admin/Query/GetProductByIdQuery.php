<?php

namespace App\Application\Cqs\Product\Admin\Query;


use App\Application\Cqs\Product\Admin\Output\ProductAdminOutput;
use App\Application\Cqs\Product\Common\Query\ProductQuery;

class GetProductByIdQuery extends ProductQuery
{
    public function execute(string $productId): ProductAdminOutput
    {
        $product = $this->productRepository->getById($productId);

        return ProductAdminOutput::fromEntity($product);
    }
}