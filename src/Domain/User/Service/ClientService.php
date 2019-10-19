<?php

namespace App\Domain\User\Service;

use App\Application\Cqs\Registration\Dto\RegistrationDto;
use App\Domain\User\Entity\Client;

interface ClientService
{
    public function registerClient(RegistrationDto $dto): Client;
}