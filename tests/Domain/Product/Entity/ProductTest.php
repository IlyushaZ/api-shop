<?php

namespace App\Tests\Domain\Product\Entity;


use App\Domain\Common\Money;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Entity\ProductContent;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Contact;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @var Product $product */
    private $product;

    protected function setUp()
    {
        $this->product = new Product(
            new ProductContent('title', 'description'),
            new Money(17.5),
            new Admin(
                new Auth('login', 'password'),
                new Contact('name', 'email', 'phone')
            )
        );
    }

    public function testGetContent()
    {
        $this->assertInstanceOf(ProductContent::class, $this->product->getContent());
        $this->assertEquals('title', $this->product->getContent()->getTitle());
        $this->assertEquals('description', $this->product->getContent()->getDescription());
    }

    public function testGetPrice()
    {
        $this->assertInstanceOf(Money::class, $this->product->getPrice());
        $this->assertEquals(17.5, $this->product->getPrice()->getValue());
    }

    public function testGetAddedBy()
    {
        $this->assertInstanceOf(Admin::class, $this->product->getAddedBy());
        $this->assertEquals('login', $this->product->getAddedBy()->getAuth()->getLogin());
    }

    public function testGetUnits()
    {
        $this->assertInstanceOf(Collection::class, $this->product->getUnits());
        $this->assertEmpty($this->product->getUnits());
    }
}