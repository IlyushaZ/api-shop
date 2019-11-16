<?php

namespace App\Infrastructure\Doctrine\Repository\Product;


use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Domain\Category\Entity\Category;
use App\Domain\Common\EntityCollection;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Repository\ProductRepository;
use App\Infrastructure\Doctrine\Repository\BaseRepository;

class ProductRepositoryImpl extends BaseRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function getAllWithFilters(ProductCriteria $criteria): EntityCollection
    {
        $queryBuilder =  $this->entityManager->createQueryBuilder()
            ->from(Product::class, 'product')
            ->select('product');

        $criteria->setRootAlias($queryBuilder);
        $criteria->mapCriteria($queryBuilder);

        return new EntityCollection($queryBuilder);
    }

    public function getById(string $productId): Product
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);

        if (null === $product) {
            throw new ProductNotFoundException($productId);
        }

        return $product;
    }
}