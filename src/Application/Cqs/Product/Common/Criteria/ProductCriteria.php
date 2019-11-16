<?php

namespace App\Application\Cqs\Product\Common\Criteria;

use App\Application\Cqs\BaseCriteria;
use Doctrine\ORM\QueryBuilder;

class ProductCriteria extends BaseCriteria
{
    /** @var string */
    public $category;

    /** @var float */
    public $priceFrom;

    /** @var float */
    public $priceTo;

    public function mapCriteria(QueryBuilder $queryBuilder)
    {
        if ($this->category) {
            $this->mapCategory($queryBuilder);
        }

        if ($this->priceFrom) {
            $this->mapPriceFrom($queryBuilder);
        }

        if ($this->priceTo) {
            $this->mapPriceTo($queryBuilder);
        }

        $this->mapSort($queryBuilder);
    }

    private function mapCategory(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder
            ->leftJoin("{$this->rootAlias}.categories", 'category')
            ->andWhere('category.id = :category')
            ->setParameter('category', $this->category);
    }

    private function mapPriceFrom(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder->andWhere("{$this->rootAlias}.price > :price")
            ->setParameter('price', $this->priceFrom);
    }

    private function mapPriceTo(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder->andWhere("{$this->rootAlias}.price < :price")
            ->setParameter('price', $this->priceTo);
    }
}