<?php
/**
 * @author jsm8946
 * @version 1.0
 * @uses Base64
 */

namespace Beef\Aes256
{
    use Beef\Base64\Base64;
    abstract class Aes256
    {
        public static function encrypt($str, $key, $iv)
        {
            return Base64::encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv));
        }
        public static function decrypt($str, $key, $iv)
        {
            return openssl_decrypt(Base64::decode($str), "AES-256-CBC", $key, 0, $iv);
        }
    }
}
?>
