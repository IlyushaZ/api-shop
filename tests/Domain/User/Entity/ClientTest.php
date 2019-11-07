<?php

namespace App\Tests\Domain\User\Entity;


use App\Domain\User\Entity\Activity;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Client;
use App\Domain\User\Entity\Contact;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ClientTest extends TestCase
{
    /** @var Client */
    private $client;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $auth = new Auth('login', 'password');
        $contact = new Contact('name', 'email@email.ru', '89999999999');

        $this->client = new Client($auth, $contact);
    }

    public function testGetType()
    {
        $this->assertEquals('Client', $this->client->getType());
    }

    public function testGetAuth()
    {
        $this->assertInstanceOf(Auth::class, $this->client->getAuth());
    }

    public function testGetContact()
    {
        $this->assertInstanceOf(Contact::class, $this->client->getContact());
    }

    public function testGetActivity()
    {
        $this->assertInstanceOf(Activity::class, $this->client->getActivity());
    }

    public function testGetId()
    {
        $this->assertEquals(Uuid::isValid($this->client->getId()), true);
    }

    public function testGetBalanceHistory()
    {
        $this->assertInstanceOf(Collection::class, $this->client->getBalanceHistory());
    }
}