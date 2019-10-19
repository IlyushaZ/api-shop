<?php

namespace App\Tests\Domain\User\Entity;


use App\Domain\User\Entity\Auth;
use App\Infrastructure\Helper\HashHelper;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    /** @var Auth */
    private $auth;

    protected function setUp(): void
    {
        $this->auth = new Auth('login', HashHelper::encodePassword('hashedPassword'));
    }

    public function testLogin()
    {
        $this->assertEquals('login', $this->auth->getLogin());
    }

    public function testHashedPassword()
    {
        $this->assertEquals(HashHelper::isPasswordValid('hashedPassword', $this->auth->getPassword()), true);
    }
}