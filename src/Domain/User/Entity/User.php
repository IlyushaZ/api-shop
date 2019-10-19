<?php

namespace App\Domain\User\Entity;

use App\Domain\Common\Traits\Entity;
use App\Infrastructure\Helper\ClassNameHelper;

abstract class User
{
    use Entity;

    protected $auth;
    protected $contact;
    protected $activity;

    public function __construct(Auth $auth, Contact $contact)
    {
        $this->identify();

        $this->auth = $auth;
        $this->contact = $contact;

        $this->activity = new Activity();
    }

    public function getAuth(): Auth
    {
        return $this->auth;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function getType(): string
    {
        return ClassNameHelper::getChildName(get_class($this));
    }
}