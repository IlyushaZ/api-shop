<?php

namespace App\Infrastructure\Helper;


class HashHelper
{
    public static function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function isPasswordValid(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}