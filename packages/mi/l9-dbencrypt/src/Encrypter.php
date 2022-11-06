<?php
/**
 * src/Encryption.php.
 *
 */
namespace Mi\L9DBEncrypt;
use DB;

class Encrypter
{
    private static $method = 'aes-128-ecb';

    /**
     * @param string $value
     * 
     * @return string
     */
    public static function encrypt($value)
    {
        return DB::connection()->select(
            "select encode(encrypt(?, ?, 'aes-cbc/pad:pkcs'), 'base64') AS text", 
            [$value, self::getKey()]
        )[0]->text;
        // return openssl_encrypt($value, self::$method, self::getKey(), 0, $iv = '');
    }

    /**
     * @param string $value
     * 
     * @return string
     */
    public static function decrypt($value)
    {
        return DB::connection()->select(
            "select convert_from(decrypt(decode(?,'base64')::bytea , ?, 'aes-cbc/pad:pkcs'), 'UTF-8') AS text", 
            [$value, self::getKey()]
        )[0]->text;
        // return openssl_decrypt($value, self::$method, self::getKey(), 0, $iv = '');
    }

    /**
     * Get app key for encryption key
     *
     * @return string
     */
    protected static function getKey()
    {
        $salt = substr(hash('sha256', env('APP_KEY')), 0, 16);
        return $salt;
    }
}