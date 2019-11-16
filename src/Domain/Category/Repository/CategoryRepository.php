<?php

namespace App\Domain\Category\Repository;


use App\Domain\Category\Entity\Category;

interface CategoryRepository
{
    public function getById(string $categoryId): Category;
}