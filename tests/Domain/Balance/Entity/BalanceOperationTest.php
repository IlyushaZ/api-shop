<?php

namespace App\Tests\Domain\Balance\Entity;


use App\Domain\Balance\Entity\BalanceOperation;
use App\Domain\Common\Money;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Client;
use App\Domain\User\Entity\Contact;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class BalanceOperationTest extends TestCase
{
    /** @var BalanceOperation */
    private $operation;

    /** @var Client */
    private $client;

    protected function setUp()
    {
        $this->client = new Client(
            new Auth('login', 'password'),
            new Contact('name', 'email', 'phone')
        );

        $this->operation = new BalanceOperation($this->client, new Money(7.5), BalanceOperation::TYPE_WITHDRAW);
    }

    /**
     * @expectedException \App\Domain\Balance\Exception\InvalidOperationTypeException
     */
    public function testValidation()
    {
        new BalanceOperation($this->client, new Money(7.5), 'enrollment');
    }

    public function testId()
    {
        $this->assertInstanceOf(Uuid::class, $this->operation->getId());
        $this->assertTrue(Uuid::isValid($this->operation->getId()));
    }

    public function testClient()
    {
        $this->assertInstanceOf(Client::class, $this->operation->getClient());
    }

    public function testAmount()
    {
        $this->assertInstanceOf(Money::class, $this->operation->getAmount());
    }

    public function testType()
    {
        $this->assertEquals(BalanceOperation::TYPE_WITHDRAW, $this->operation->getType());
    }
}