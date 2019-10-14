<?php

namespace App\Application\Http;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController
{
    /**
     * @Route("", methods={"POST"})
     */
    public function index()
    {
    }
}