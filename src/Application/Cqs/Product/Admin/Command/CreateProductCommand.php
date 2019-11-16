<?php

namespace App\Application\Cqs\Product\Admin\Command;


use App\Application\Cqs\Product\Admin\Dto\ProductDto;
use App\Application\Cqs\Product\Admin\Output\ProductAdminOutput;
use App\Domain\User\Entity\Admin;

class CreateProductCommand extends ProductCommand
{
    public function execute(Admin $admin, ProductDto $dto): ProductAdminOutput
    {
        $product = $this->service->create($admin, $dto);

        return ProductAdminOutput::fromEntity($product);
    }
}