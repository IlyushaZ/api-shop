<?php

namespace App\Application\Cqs;


use Doctrine\ORM\QueryBuilder;

abstract class BaseCriteria
{
    protected $rootAlias;

    /** @var string */
    public $sort = 'createdAt';

    /** @var string  */
    public $order = 'desc';

    public function setRootAlias(QueryBuilder $queryBuilder): self
    {
        $this->rootAlias = $queryBuilder->getRootAliases()[0];
        return $this;
    }

    public function mapSort(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder->orderBy("{$this->rootAlias}.{$this->sort}", $this->order);
    }

    public abstract function mapCriteria(QueryBuilder $queryBuilder);
}