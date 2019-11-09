<?php

namespace App\Domain\UnitOfProduct\Entity;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\IsAvailable;
use App\Domain\Common\Traits\UpdatedAt;
use App\Domain\Product\Entity\Product;
use Assert\Assertion;

class UnitOfProduct
{
    use Entity, CreatedAt, UpdatedAt, IsAvailable;

    public const STATUS_IN_STOCK = 'inStock';
    public const STATUS_IN_CART = 'inCart';
    public const STATUS_PURCHASED = 'purchased';

    public const UNIT_STATUSES = [
        self::STATUS_IN_STOCK,
        self::STATUS_IN_CART,
        self::STATUS_PURCHASED,
    ];

    private $serialNumber;
    private $product;
    private $status;

    public function __construct(string $serialNumber, Product $product)
    {
        $this->identify();

        $this->serialNumber = $serialNumber;
        $this->product = $product;
        $this->status = self::STATUS_IN_STOCK;

        $this->onCreated();
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        Assertion::true(
            in_array($status, self::UNIT_STATUSES),
            'Given status in invalid.'
        );

        $this->status = $status;
        return $this;
    }
}