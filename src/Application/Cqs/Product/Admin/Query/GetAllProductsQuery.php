<?php

namespace App\Application\Cqs\Product\Admin\Query;


use App\Application\Cqs\Product\Admin\Output\ProductAdminOutput;
use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Application\Cqs\Product\Common\Query\ProductQuery;
use App\Domain\Common\PaginatedContent;

class GetAllProductsQuery extends ProductQuery
{
    public function execute(ProductCriteria $criteria, int $limit, int $offset): PaginatedContent
    {
        $products = $this->productRepository->getAllWithFilters($criteria);

        return ProductAdminOutput::toPaginated($products, $limit, $offset);
    }
}