<?php

namespace App\Tests\Domain\Common;


use App\Domain\Common\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testValue()
    {
        $value = 1.5;
        $money = new Money($value);

        $this->assertInstanceOf(Money::class, $money);
        $this->assertEquals($value, $money->getValue());
    }
}