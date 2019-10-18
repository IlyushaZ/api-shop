<?php

namespace App\Application\Http\Client;
use App\Application\Cqs\Registration\Command\RegisterClientCommand;
use App\Application\Cqs\Registration\Dto\RegistrationDto;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/register")
 */
class RegistrationController
{
    /**
     * @Route("", methods={"POST"})
     */
    public function register(RegisterClientCommand $command, RegistrationDto $dto)
    {
        return $command->execute($dto);
    }
}