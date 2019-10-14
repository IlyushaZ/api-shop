<?php

namespace App\Infrastructure\Doctrine;


use Doctrine\ORM\EntityManagerInterface;

abstract class BaseRepository
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}