<?php

namespace App\Infrastructure\Http\Listener;


use App\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ValidationExceptionListener
{
    public function handle(ExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof ValidationException) {
            return;
        }

        $response = JsonResponse::create();

        $event->allowCustomResponseCode();
        $response->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->setData([
            'type' => 'Validation exception',
            'errors' => $exception->getMessages()
        ]);

        $event->setResponse($response);
    }
}