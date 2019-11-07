<?php

namespace App\Domain\User\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Client extends User
{
    private $balanceHistory;

    public function __construct(Auth $auth, Contact $contact)
    {
        parent::__construct($auth, $contact);

        $this->balanceHistory = new ArrayCollection();
    }

    public function getBalanceHistory(): Collection
    {
        return $this->balanceHistory;
    }
}