<?php

namespace App\Infrastructure\Http\Listener\Jwt;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JwtNotFoundListener
{
    public function handle(JWTNotFoundEvent $event)
    {
        $response = JsonResponse::create();

        $response->setStatusCode(JsonResponse::HTTP_FORBIDDEN);
        $response->setData([
            'type' => 'JWT NOT FOUND',
            'message' => 'JWT TOKEN IS NOT FOUND'
        ]);

        $event->setResponse($response);
    }
}