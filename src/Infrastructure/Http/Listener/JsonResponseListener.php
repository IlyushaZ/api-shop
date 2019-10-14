<?php

namespace App\Infrastructure\Http\Listener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\SerializerInterface;

class JsonResponseListener
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(ViewEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof Response) {
            return;
        }

        $request = $event->getRequest();
        $response = JsonResponse::create();

        if (null !== $result) {
            $response->setJson($this->serialize($result));
            $response->setStatusCode(
                $request->isMethod(Request::METHOD_POST) ? JsonResponse::HTTP_CREATED : JsonResponse::HTTP_OK
            );
        } else {
            $response->setStatusCode(JsonResponse::HTTP_NO_CONTENT);
        }

        $event->setResponse($response);
    }

    private function serialize($content): string
    {
        return sprintf('{"type": "SUCCESS", data: %s}', $this->serializer->serialize($content, 'json'));
    }
}