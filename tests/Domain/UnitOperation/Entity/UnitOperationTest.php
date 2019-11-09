<?php

namespace App\Tests\Domain\UnitOperation\Entity;


use App\Domain\Common\Money;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Entity\ProductContent;
use App\Domain\UnitOfProduct\Entity\UnitOfProduct;
use App\Domain\UnitOperation\Entity\UnitOperation;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Client;
use App\Domain\User\Entity\Contact;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UnitOperationTest extends TestCase
{
    private $unitOperation;
    private $unitOfProduct;
    private $client;

    protected function setUp()
    {
        $productContent = new ProductContent('title', 'description');
        $money = new Money(17.5);
        $auth = new Auth('login', 'password');
        $contact = new Contact('name', 'email', 'phone');
        $admin = new Admin($auth, $contact);

        $product = new Product($productContent, $money, $admin);
        $this->client = new Client($auth, $contact);

        $this->unitOfProduct = new UnitOfProduct('123456789', $product);
        $this->unitOperation = new UnitOperation($this->unitOfProduct, $this->client, UnitOperation::TYPE_PURCHASE);
    }

    public function testGetUnitOfProduct()
    {
        $this->assertEquals($this->unitOfProduct, $this->unitOperation->getUnitOfProduct());
    }

    public function testGetClient()
    {
        $this->assertEquals($this->client, $this->unitOperation->getClient());
    }

    public function testGetType()
    {
        $this->assertEquals('purchase', $this->unitOperation->getType());
    }

    public function testTypeValidation()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnitOperation($this->unitOfProduct, $this->client, 'wrongType');
    }
}