<?php

namespace App\Domain\Common\Traits;


trait CreatedAt
{
    protected $createdAt;

    public function onCreated(): self
    {
        $this->createdAt = new \DateTimeImmutable('now');
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}