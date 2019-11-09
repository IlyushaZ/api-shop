<?php

namespace App\Domain\UnitOperation\Entity;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\UnitOfProduct\Entity\UnitOfProduct;
use App\Domain\User\Entity\Client;
use Assert\Assertion;

class UnitOperation
{
    use Entity, CreatedAt;

    public const TYPE_PURCHASE = 'purchase';
    public const TYPE_RETURN = 'return';

    public const OPERATION_TYPES = [
        self::TYPE_PURCHASE,
        self::TYPE_RETURN,
    ];

    private $unitOfProduct;
    private $client;
    private $type;

    public function __construct(UnitOfProduct $unitOfProduct, Client $client, string $type)
    {
        Assertion::true(in_array($type, self::OPERATION_TYPES), 'Invalid operation types');

        $this->unitOfProduct = $unitOfProduct;
        $this->client = $client;
        $this->type = $type;
    }

    public function getUnitOfProduct(): UnitOfProduct
    {
        return $this->unitOfProduct;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getType(): string
    {
        return $this->type;
    }
}