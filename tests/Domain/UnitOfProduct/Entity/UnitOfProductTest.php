<?php

namespace App\Tests\Domain\UnitOfProduct\Entity;


use App\Domain\Product\Entity\Product;
use App\Domain\UnitOfProduct\Entity\UnitOfProduct;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UnitOfProductTest extends TestCase
{
    /** @var UnitOfProduct $unitOfProduct */
    private $unitOfProduct;
    private $product;

    protected function setUp()
    {
        $this->product = $this->createMock(Product::class);
        $this->unitOfProduct = new UnitOfProduct('123456789', $this->product);
    }

    public function testGetSerialNumber()
    {
        $this->assertEquals('123456789', $this->unitOfProduct->getSerialNumber());
    }

    public function testGetProduct()
    {
        $this->assertEquals($this->product, $this->unitOfProduct->getProduct());
    }

    public function testGetStatus()
    {
        $this->assertEquals(UnitOfProduct::STATUS_IN_STOCK, $this->unitOfProduct->getStatus());
    }

    public function testSetStatus()
    {
        $this->unitOfProduct->setStatus(UnitOfProduct::STATUS_PURCHASED);
        $this->assertEquals(UnitOfProduct::STATUS_PURCHASED, $this->unitOfProduct->getStatus());
    }

    public function testStatusValidation()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->unitOfProduct->setStatus('wrongStatus');
    }
}