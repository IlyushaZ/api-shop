<?php

namespace App\Domain\Common\Traits;


trait IsAvailable
{
    protected $isAvailable = true;

    public function archive(): self
    {
        $this->isAvailable = false;
        return $this;
    }

    public function makeAvailable(): self
    {
        $this->isAvailable = true;
        return $this;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }
}