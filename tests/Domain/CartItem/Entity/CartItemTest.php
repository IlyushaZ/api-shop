<?php

namespace App\Tests\Domain\CartItem\Entity;


use App\Domain\CartItem\Entity\CartItem;
use App\Domain\Common\Money;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Entity\ProductContent;
use App\Domain\UnitOfProduct\Entity\UnitOfProduct;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Client;
use App\Domain\User\Entity\Contact;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    /** @var CartItem $cartItem */
    private $cartItem;
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
        $this->cartItem = new CartItem($this->unitOfProduct, $this->client);
    }

    public function testGetUnitOfProduct()
    {
        $this->assertInstanceOf(UnitOfProduct::class, $this->cartItem->getUnitOfProduct());
        $this->assertEquals($this->unitOfProduct, $this->cartItem->getUnitOfProduct());
    }

    public function testGetClient()
    {
        $this->assertEquals($this->client, $this->cartItem->getClient());
        $this->assertInstanceOf(Client::class, $this->cartItem->getClient());
    }

    public function testIsRemoved()
    {
        $this->assertFalse($this->cartItem->isRemoved());
    }

    public function testRemove()
    {
        $this->cartItem->remove();
        $this->assertTrue($this->cartItem->isRemoved());
    }
}