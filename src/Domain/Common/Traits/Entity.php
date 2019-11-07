<?php

namespace App\Domain\Common\Traits;


use Ramsey\Uuid\Uuid;

trait Entity
{
    protected $id;

    public function identify(): self
    {
        $this->id = Uuid::uuid4();
        return $this;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}