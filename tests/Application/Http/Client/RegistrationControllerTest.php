<?php

namespace App\Tests\Application\Http\Client;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $client->request('POST', '/register', [], [], [], json_encode([
            'login' => 'login',
            'password' => '123321',
            'passwordConfirmation' => '123321',
            'name' => 'name',
            'email' => 'email@email.ru',
            'phone' => '89999999999'
        ]));

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testRegisterDuplicate()
    {
        $client = static::createClient();

        $client->request('POST', '/register', [], [], [], json_encode([
            'login' => 'login',
            'password' => '123321',
            'passwordConfirmation' => '123321',
            'name' => 'name',
            'email' => 'email@email.ru',
            'phone' => '89999999999'
        ]));

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}