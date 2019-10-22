<?php

namespace App\Infrastructure\Http\Listener\Jwt;


use App\Application\Security\SecurityAdapter;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function handle(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        /** @var SecurityAdapter $user */
        $unwrappedUser = $user->unwrapUser();

        $data['userType'] = $unwrappedUser->getType();

        $event->setData($data);
    }
}