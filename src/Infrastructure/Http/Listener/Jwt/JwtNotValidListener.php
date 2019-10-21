<?php

namespace App\Infrastructure\Http\Listener\Jwt;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JwtNotValidListener
{
    public function handle(JWTInvalidEvent $event)
    {
        $response = JsonResponse::create();

        $response->setStatusCode(JsonResponse::HTTP_FORBIDDEN);
        $response->setData([
            'type' => 'INVALID JWT',
            'message' => 'JWT TOKEN IS INVALID'
        ]);

        $event->setResponse($response);
    }
}