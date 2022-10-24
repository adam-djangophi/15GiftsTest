<?php

namespace App\Helpers;

class NumberHelper
{
    public static function stripCommasFromNumericInt(string $string): int
    {
        return (int) self::stripCommasFromNumeric($string);
    }

    public static function stripCommasFromNumeric(string $string): string
    {
        return str_replace(',', '', trim($string));
    }

    public static function testMe($x)
    {
        return $x;
    }


    public static function testMe2($x)
    {
        return $x;
    }
}
