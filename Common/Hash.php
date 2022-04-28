<?php

namespace Common;

class Hash 
{
    public static function makeHash(string $str): string
    {
        return password_hash($str, PASSWORD_DEFAULT);
    }


    public static function checkHash(string $str, string $hash): bool
    {
        return password_verify($str, $hash);
    }
}