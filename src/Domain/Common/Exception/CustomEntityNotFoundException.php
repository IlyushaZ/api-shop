<?php

namespace App\Domain\Common\Exception;


use Doctrine\ORM\EntityNotFoundException;
use Throwable;

abstract class CustomEntityNotFoundException extends EntityNotFoundException
{
    private $messageLayout = 'was not found!';

    public function __construct(string $entityId = null, string $message = "", int $code = 0, Throwable $previous = null)
    {
        if ($entityId && empty($message)) {
            $message = $this->buildMessageWithId($entityId);
        }

        if (!$entityId && empty($message)) {
            $message = $this->buildMessageWithoutId();
        }

        parent::__construct($message, $code, $previous);
    }

    private function buildMessageWithId(string $entityId): string
    {
        return ucfirst("{$this->getEntityName()} with id {$entityId} {$this->messageLayout}");
    }

    private function buildMessageWithoutId(): string
    {
        return ucfirst("{$this->getEntityName()} {$this->messageLayout}");
    }

    abstract public function getEntityName(): string;
}