<?php

namespace App\Domain\Common\Traits;


trait IsConfirmed
{
    protected $isConfirmed = false;

    public function confirm(): self
    {
        $this->isConfirmed = true;
        return $this;
    }

    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }
}