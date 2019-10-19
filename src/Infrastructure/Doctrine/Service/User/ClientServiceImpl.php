<?php

namespace App\Infrastructure\Doctrine\Service\User;

use App\Application\Cqs\Registration\Dto\RegistrationDto;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Client;
use App\Domain\User\Entity\Contact;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\Service\ClientService;
use App\Infrastructure\Helper\HashHelper;

class ClientServiceImpl extends UserServiceAbstract implements ClientService
{
    public function registerClient(RegistrationDto $dto): Client
    {
        $this->checkIfUserIsUnique($dto);

        $client = new Client($this->buildAuthObject($dto), $this->buildContactObject($dto));
        parent::registerUser($client);

        return $client;
    }

    private function checkIfUserIsUnique(RegistrationDto $dto): void
    {
        if ($this->userRepository->checkIfUserWithEmailExists($dto->email)) {
            throw UserAlreadyExistsException::emailIsAlreadyInUse($dto->email);
        }

        if ($this->userRepository->checkIfUserWithLoginExists($dto->login)) {
            throw UserAlreadyExistsException::loginIsAlreadyInUse($dto->login);
        }

        if ($this->userRepository->checkIfUserWithPhoneNumberExists($dto->phone)) {
            throw UserAlreadyExistsException::phoneNumberIsAlreadyInUse($dto->phone);
        }
    }

    private function buildAuthObject(RegistrationDto $dto): Auth
    {
        return new Auth(
            $dto->login,
            HashHelper::encodePassword($dto->password)
        );
    }

    private function buildContactObject(RegistrationDto $dto): Contact
    {
        return new Contact(
            $dto->name,
            $dto->email,
            $dto->phone
        );
    }
}