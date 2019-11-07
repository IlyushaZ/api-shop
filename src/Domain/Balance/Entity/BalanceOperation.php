<?php

namespace App\Domain\Balance\Entity;


use App\Domain\Balance\Exception\InvalidOperationTypeException;
use App\Domain\Common\Money;
use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\User\Entity\Client;

final class BalanceOperation
{
    use Entity, CreatedAt;

    public const TYPE_WITHDRAW = 'withdraw';
    public const TYPE_REFILL = 'refill';
    public const TYPE_RETURN = 'return';

    public const OPERATION_TYPES = [
        self::TYPE_WITHDRAW,
        self::TYPE_REFILL,
        self::TYPE_RETURN
    ];

    private $client;
    private $amount;
    private $type;

    public function __construct(Client $client, Money $amount, string $type)
    {
        self::validateType($type);

        $this->identify();

        $this->client = $client;
        $this->amount = $amount;
        $this->type = $type;

        $this->onCreated();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    private static function validateType(string $type)
    {
        if (!in_array($type, self::OPERATION_TYPES)) {
            throw new InvalidOperationTypeException('This type of operation is not supported!');
        }
    }
}