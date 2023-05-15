<?php
/**
 * @author jsm8946
 * @version 1.0
 */

namespace Beef\Base64
{
    abstract class Base64
    {
        public static function encode($data)
        {
            return base64_encode($data);
        }
        public static function decode($data)
        {
            return base64_decode($data);
        }
    }
}
?>
