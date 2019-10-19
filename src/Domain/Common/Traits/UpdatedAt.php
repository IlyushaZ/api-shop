<?php

namespace App\Domain\Common\Traits;


trait UpdatedAt
{
    protected $updatedAt;

    public function onUpdated(): self
    {
        $this->updatedAt = new \DateTimeImmutable('now');
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}