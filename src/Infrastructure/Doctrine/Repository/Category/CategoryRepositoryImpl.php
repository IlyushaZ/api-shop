<?php

namespace App\Infrastructure\Doctrine\Repository\Category;


use App\Domain\Category\Entity\Category;
use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepository;
use App\Infrastructure\Doctrine\Repository\BaseRepository;

class CategoryRepositoryImpl extends BaseRepository implements CategoryRepository
{
    public function getById(string $categoryId): Category
    {
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['id' => $categoryId]);

        if (null === $category) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }
}