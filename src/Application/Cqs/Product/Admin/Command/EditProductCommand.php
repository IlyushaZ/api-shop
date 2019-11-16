<?php

namespace App\Application\Cqs\Product\Admin\Command;


use App\Application\Cqs\Product\Admin\Dto\ProductDto;
use App\Application\Cqs\Product\Admin\Output\ProductAdminOutput;

class EditProductCommand extends ProductCommand
{
    public function execute(string $productId, ProductDto $dto): ProductAdminOutput
    {
        $product = $this->service->edit($productId, $dto);

        return ProductAdminOutput::fromEntity($product);
    }
}