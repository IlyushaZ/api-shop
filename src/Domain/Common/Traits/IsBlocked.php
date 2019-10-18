<?php

namespace App\Domain\Common\Traits;


trait IsBlocked
{
    protected $isBlocked = false;

    public function block(): self
    {
        $this->isBlocked = true;
        return $this;
    }

    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }
}