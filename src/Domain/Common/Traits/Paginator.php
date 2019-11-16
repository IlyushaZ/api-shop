<?php

namespace App\Domain\Common\Traits;


use App\Domain\Common\EntityCollection;
use App\Domain\Common\PaginatedContent;

trait Paginator
{
    abstract function fromEntity($entity, ...$params): self;

    public static function toPaginated(EntityCollection $collection, int $limit, int $offset, ...$params): PaginatedContent
    {
        $data = $collection->getCollection($limit, $offset);
        $totalCount = $collection->getTotalCount();

        return new PaginatedContent(self::toArray($data, $params), $limit, $totalCount);
    }

    private static function toArray(iterable $data, ...$params): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = static::fromEntity($item, $params);
        }

        return $result;
    }
}