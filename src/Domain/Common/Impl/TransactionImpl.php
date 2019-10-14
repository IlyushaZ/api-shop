<?php

namespace App\Domain\Common\Impl;


use App\Domain\Common\Transaction;
use Doctrine\ORM\EntityManagerInterface;

class TransactionImpl implements Transaction
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function makeTransaction(callable $scope)
    {
        $this->entityManager->beginTransaction();

        try {
            $returned = $scope();

            $this->entityManager->flush();
            $this->entityManager->commit();

            return $returned;
        } catch (\Exception $exception) {
            $this->entityManager->close();
            $this->entityManager->rollback();

            throw $exception;
        }
    }
}