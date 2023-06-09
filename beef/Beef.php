<?php
/**
 * @author jsm8946
 * @version 1.0
 */

namespace Beef
{
    class BeefException extends \Exception
    {
        // May be extended by libraries
        public function __construct($msg)
        {
            $this->message = $msg;
        }
    }
    abstract class CodeLoader
    {
        public static function addCode($code)
        {
            try
            {
                $code();
            }
            catch(BeefException $e)
            {
                echo "<strong>".get_class($e).": </strong>".$e->getMessage()."\n";
            }
        }
    }
    class FileException extends BeefException
    {
        // Nothing new. Just a new form of BeefException
    }
    final class File
    {
        const W = "w";
        const R = "r";
        const A = "a";
        const X = "x";
        const W1 = "w+";
        const R1 = "r+";
        const A1 = "a+";
        const X1 = "x+";
        private $file;
        public function __construct($f, $m)
        {
            $this->file = fopen($f, $m) or throw new FileException("Unable to open $f");
        }
        public function close()
        {
            close($this->file);
        }
        public static function exists($f)
        {
            return file_exists($f);
        }
        public static function createFile($f)
        {
            try
            {
                $file = new File($f, File::X);
            }
            catch(FileException $fe)
            {
                throw new FileException("Unable to create $f"); 
            }
        }
        public function fileSize()
        {
            return filesize($this->file);
        }
        public function read()
        {
            return fread($this->file, $this->fileSize());
        }
        public function eof()
        {
            return feof($this->file);
        }
        public function gets()
        {
            return fgets($this->file);
        }
        public function rewind()
        {
            rewind($this->file);
        }
        public function getArray()
        {
            $array = [];
            while(!$this->eof())
            {
                array_push($array, $this->gets());
            }
            $this->rewind();
        }
        public function getLine($line)
        {
            $array = $this->getArray();
            return $array[$line - 1];
        }
        public function write($text)
        {
            fwrite($this->file, $text);
        }
    }
    abstract class LibraryLoader
    {
        public static function library($name)
        {
            require_once("beef/$name.php");
        }
    }
}
?>
