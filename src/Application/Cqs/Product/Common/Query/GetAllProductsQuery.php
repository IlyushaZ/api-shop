<?php

namespace App\Application\Cqs\Product\Common\Query;


use App\Application\Cqs\Product\Client\Output\ProductClientOutput;
use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Domain\Common\PaginatedContent;

class GetAllProductsQuery extends ProductQuery
{
    public function execute(ProductCriteria $criteria, int $limit, int $offset): PaginatedContent
    {
        $products = $this->productRepository->getAllWithFilters($criteria);

        return ProductClientOutput::toPaginated($products, $limit, $offset);
    }
}