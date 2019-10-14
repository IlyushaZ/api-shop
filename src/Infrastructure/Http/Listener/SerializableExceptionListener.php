<?php

namespace App\Infrastructure\Http\Listener;


use App\Application\Exception\SerializableException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class SerializableExceptionListener
{
    public function handle(ExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof SerializableException) {
            return;
        }

        $response = JsonResponse::create();
        $response->headers->set('X-Response-Type', 'FAILURE');

        $event->allowCustomResponseCode();
        $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

        $response->setData([
            'type' => 'exception',
            'message' => $exception->getMessage()
        ]);

        $event->setResponse($response);
    }
}