<?php
/**
  * @author jsm8946
  * @version 1.0
*/

namespace Beef\NoSQLi
{
    abstract class Sanitizer
    {
        public static function sanitizeQ($query, $args)
        {
            $clean = "";
            $query_parts = explode("%s", $query);
            foreach($args as $i => $arg)
            {
                $clean .= $query_parts[$i];
                $clean .= $arg;
            }
            if(count($query_parts) > count($args))
            {
                $clean .= $query_parts[count($query_parts) - 1];
            }
            return $clean;
        }
    }
}
?>
