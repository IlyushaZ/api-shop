<?php

namespace App\Application\Cqs\User\Common\Output;


use App\Domain\User\Entity\Activity;
use App\Domain\User\Entity\Contact;
use App\Domain\User\Entity\User;

class UserOutput
{
    /** @var string */
    public $id;

    /** @var string */
    public $login;

    /** @var Contact */
    public $contact;

    /** @var Activity */
    public $activity;

    public static function fromEntity(User $user): self
    {
        $self = new self();

        $self->id = $user->getId();
        $self->login = $user->getAuth()->getLogin();
        $self->contact = $user->getContact();
        $self->activity = $user->getActivity();

        return $self;
    }
}