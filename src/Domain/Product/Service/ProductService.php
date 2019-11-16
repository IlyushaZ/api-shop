<?php

namespace App\Domain\Product\Service;

use App\Application\Cqs\Product\Admin\Dto\ProductDto;
use App\Domain\Product\Entity\Product;
use App\Domain\User\Entity\Admin;

interface ProductService
{
    public function create(Admin $admin, ProductDto $dto): Product;
    public function edit(string $productId, ProductDto $dto): Product;
    public function archive(string $productId): void;
}