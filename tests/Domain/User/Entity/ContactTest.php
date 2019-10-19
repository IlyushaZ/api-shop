<?php

namespace App\Tests\Domain\User\Entity;


use App\Domain\User\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /** @var Contact */
    private $contact;

    protected function setUp()
    {
        $this->contact = new Contact('name', 'email@email.ru', '89999999999');
    }

    public function testGetName()
    {
        $this->assertEquals('name', $this->contact->getName());
    }

    public function testGetEmail()
    {
        $this->assertEquals('email@email.ru', $this->contact->getEmail());
    }

    public function testGetPhone()
    {
        $this->assertEquals('89999999999', $this->contact->getPhone());
    }
}