<?php

namespace Common;

class Crypt 
{

    private static $key = 'qualquerstringloka';
    private static $algo = 'aes-256-cbc';

    public static function encrypt(mixed $data): string
    {
        $serialize = serialize($data);
        return openssl_encrypt($serialize, self::$algo, self::$key, 0, self::getIv());
    }

    public static function decrypt(string $str): mixed
    {
        $res = openssl_decrypt($str, self::$algo, self::$key, 0, self::getIv());
        return unserialize($res);
    }

    private static function getIv(): string
    {
        return substr(hash('sha256', self::$algo), 0, 16);
    }
}