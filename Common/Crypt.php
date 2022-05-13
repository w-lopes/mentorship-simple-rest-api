<?php

namespace Common;

class Crypt 
{

    private static $key  = 'qualquerstringloka';
    private static $algo = 'aes-256-cbc';

    public static function encrypt(mixed $data): string
    {
        $serialize = serialize($data);
        $ivlen     = openssl_cipher_iv_length(self::$algo);
        $iv        = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt(
            $serialize,
            self::$algo,
            self::$key,
            OPENSSL_RAW_DATA,
            $iv
        );
        return base64_encode($iv . $encrypted);
    }

    public static function decrypt(string $str): mixed
    {
        $encrypted = base64_decode($str);
        $ivlen     = openssl_cipher_iv_length(self::$algo);
        $iv        = substr($encrypted, 0, $ivlen);
        $raw       = substr($encrypted, $ivlen);
        $decrypted = openssl_decrypt($raw, self::$algo, self::$key, OPENSSL_RAW_DATA, $iv);
        return unserialize($decrypted);
    }
}
