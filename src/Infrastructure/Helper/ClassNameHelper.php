<?php

namespace App\Infrastructure\Helper;


class ClassNameHelper
{
    public static function getChildName(string $className): string
    {
        $fullClassName = explode("\\", $className);
        return end($fullClassName);
    }
}