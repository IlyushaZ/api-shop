<?php

namespace App\Application\Cqs\Registration\Command;


use App\Application\Cqs\Registration\Dto\RegistrationDto;
use App\Application\Cqs\User\Common\Output\UserOutput;
use App\Domain\User\Service\ClientService;

class RegisterClientCommand
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function execute(RegistrationDto $dto): UserOutput
    {
        return UserOutput::fromEntity($this->clientService->registerClient($dto));
    }
}