<?php

namespace App\Infrastructure\Doctrine\Service\User;


use App\Domain\Common\Transaction;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;

abstract class UserServiceAbstract
{
    protected $userRepository;
    private $transaction;

    public function __construct(UserRepository $userRepository, Transaction $transaction)
    {
        $this->userRepository = $userRepository;
        $this->transaction = $transaction;
    }

    protected function registerUser(User $user): void
    {
        $this->transaction->makeTransaction(function () use ($user) {
            $this->userRepository->save($user);
        });
    }
}