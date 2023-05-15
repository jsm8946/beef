<?php
// A sample of BEEF
require_once("beef/Beef.php");
Beef\CodeLoader::addCode(function()
{
    echo "Hello World!";
});
?>
