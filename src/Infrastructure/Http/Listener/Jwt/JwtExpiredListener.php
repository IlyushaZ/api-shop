<?php

namespace App\Infrastructure\Http\Listener\Jwt;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JwtExpiredListener
{
    public function handle(JWTExpiredEvent $event)
    {
        $response = JsonResponse::create();

        $response->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED);
        $response->setData([
            'type' => 'EXPIRED JWT',
            'message' => 'JWT TOKEN IS EXPIRED'
        ]);

        $event->setResponse($response);
    }
}