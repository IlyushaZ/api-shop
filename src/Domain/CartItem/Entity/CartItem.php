<?php

namespace App\Domain\CartItem\Entity;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\IsRemoved;
use App\Domain\UnitOfProduct\Entity\UnitOfProduct;
use App\Domain\User\Entity\Client;

class CartItem
{
    use Entity, CreatedAt, IsRemoved;

    private $unitOfProduct;
    private $client;

    public function __construct(UnitOfProduct $unitOfProduct, Client $client)
    {
        $this->unitOfProduct = $unitOfProduct;
        $this->client = $client;
    }

    public function getUnitOfProduct(): UnitOfProduct
    {
        return $this->unitOfProduct;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}