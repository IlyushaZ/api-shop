<?php

namespace App\Application\Cqs\Product\Client\Output;


use App\Application\Cqs\Product\Common\Output\ProductOutput;
use App\Domain\Common\Traits\Paginator;
use App\Domain\Product\Entity\Product;

class ProductClientOutput extends ProductOutput
{
    use Paginator;

    public static function fromEntity(Product $product): self
    {
        $result = new static();

        $result->id = $product->getId();
        $result->content = $product->getContent();
        $result->price = $product->getPrice()->getValue();
        $result->categories = $product->getCategories()->toArray();
        $result->isAvailable = $product->isAvailable();

        return $result;
    }
}