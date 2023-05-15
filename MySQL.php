<?php
/**
 * @author jsm8946
 * @version 0.0
 */

namespace Beef\MySQL
{
    use Beef\BeefException;
    class MySQLException extends BeefException
    {
        // This class has no special features; another form of BeefException
    }
    class Connection
    {
        private $h;
        private $u;
        private $p;
        private $n;
        public function __construct($h = "localhost", $u = "root", $p = "", $n = "test")
        {
            $this->h = $h;
            $this->u = $u;
            $this->p = $p;
            $this->n = $n;
        }
        public function connect()
        {
            return @new \mysqli($this->h, $this->u, $this->p, $this->n) or throw new MySQLException("Cannot connect to $n in $h as $u:$p. ".mysqli_connect_error());
        }
        public function realEscapeString($str)
        {
            return mysqli_real_escape_string($str);
        }
    }
    class Query
    {
        private $q;
        public function __construct($con, $query)
        {
            $dbcon = $con->connect();
            try
            {
                $this->q = mysqli_query($dbcon, $query);
            }
            catch(\Exception $e)
            {
                throw new MySQLException("$query: query failed. ".$e->getMessage());
            }
        }
        public function getResult()
        {
            return $this->q;
        }
        public function fetchRow()
        {
            return mysqli_fetch_row($this->q);
        }
        public function fetchArray()
        {
            return mysqli_fetch_array($this->q);
        }
        public function fetchAssoc()
        {
            return mysqli_fetch_assoc($this->q);
        }
    }
}
?>
