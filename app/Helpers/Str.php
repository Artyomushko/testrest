<?php

namespace App\Helpers;

class Str
{
    public static function snakeToCamel(string $str): string
    {
        $strArray = explode('_', $str);
        $result = array_shift($strArray);
        while(($part = array_shift($strArray)) !== null) {
            $result .= ucfirst($part);
        }
        return $result;
    }
}