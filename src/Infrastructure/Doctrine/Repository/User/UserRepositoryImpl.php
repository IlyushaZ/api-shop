<?php

namespace App\Infrastructure\Doctrine\Repository\User;


use App\Domain\User\Entity\User;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Repository\UserRepository;
use App\Infrastructure\Doctrine\Repository\BaseRepository;

class UserRepositoryImpl extends BaseRepository implements UserRepository
{
    public function findByLogin(string $login): User
    {
        $user = $this->entityManager->createQueryBuilder()
            ->from(User::class, 'user')
            ->select('user')
            ->where('user.auth.login = :login')
            ->setParameter('login', $login)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $user) {
            throw new UserNotFoundException(null, "User with login {$login} was not found!");
        }

        return $user;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function checkIfUserWithEmailExists(string $email): bool
    {
        $users = $this->entityManager->getRepository(User::class)->findBy(['contact.email' => $email]);

        return count($users) > 0;
    }

    public function checkIfUserWithLoginExists(string $login): bool
    {
        $users = $this->entityManager->getRepository(User::class)->findBy(['auth.login' => $login]);

        return count($users) > 0;
    }

    public function checkIfUserWithPhoneNumberExists(string $phone): bool
    {
        $users = $this->entityManager->getRepository(User::class)->findBy(['contact.phone' => $phone]);

        return count($users) > 0;
    }
}