<?php

namespace App\Application\Http;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index()
    {
        return new Response('hey');
    }
}