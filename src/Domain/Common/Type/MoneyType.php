<?php

namespace App\Domain\Common\Type;


use App\Domain\Common\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class MoneyType extends Type
{
    private const TYPE_MONEY = 'money';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Money($value ?? 0.00);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return !is_null($value) ? $value->getValue() : null;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getFloatDeclarationSQL($fieldDeclaration);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    public function getName()
    {
        return self::TYPE_MONEY;
    }
}