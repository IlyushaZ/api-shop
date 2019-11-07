<?php

namespace App\Domain\Common\Traits;


trait IsRemoved
{
    protected $isRemoved = false;

    public function remove(): self
    {
        $this->isRemoved = true;
        return $this;
    }

    public function isRemoved(): bool
    {
        return $this->isRemoved;
    }
}