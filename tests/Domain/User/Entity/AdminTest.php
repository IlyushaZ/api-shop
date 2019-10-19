<?php

namespace App\Tests\Domain\User\Entity;


use App\Domain\User\Entity\Activity;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Contact;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AdminTest extends TestCase
{
    /** @var Admin */
    private $admin;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $auth = new Auth('login', 'password');
        $contact = new Contact('name', 'email@email.ru', '89999999999');

        $this->admin = new Admin($auth, $contact);
    }

    public function testGetType()
    {
        $this->assertEquals('Admin', $this->admin->getType());
    }

    public function testGetAuth()
    {
        $this->assertInstanceOf(Auth::class, $this->admin->getAuth());
    }

    public function testGetContact()
    {
        $this->assertInstanceOf(Contact::class, $this->admin->getContact());
    }

    public function testGetActivity()
    {
        $this->assertInstanceOf(Activity::class, $this->admin->getActivity());
    }

    public function testGetId()
    {
        $this->assertEquals(Uuid::isValid($this->admin->getId()), true);
    }
}