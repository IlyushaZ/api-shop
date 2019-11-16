<?php

namespace App\Domain\Common;

use Doctrine\ORM\QueryBuilder;

class EntityCollection
{
    private $alias;
    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->alias = $queryBuilder->getRootAliases()[0];
        $this->queryBuilder = $queryBuilder;
    }

    public function getCollection(int $limit = null, int $offset = null): array
    {
        $collection = $this->queryBuilder->select($this->alias);

        if ($limit) {
            $this->queryBuilder->setMaxResults($limit);
        }

        if ($offset) {
            $this->queryBuilder->setFirstResult($offset);
        }

        return $collection->getQuery()->getResult();
    }

    public function getTotalCount(): int
    {
        $queryBuilder = clone $this->queryBuilder;
        $queryBuilder->resetDQLParts(['orderBy', 'groupBy']);

        return $queryBuilder->select("COUNT({$this->alias})")->getQuery()->getSingleScalarResult();
    }
}