<?php
class Database {
    private $connection;
    
    private function __construct() {
        $this->connection = mysqli_connect('54.227.215.252','b2b2bd32573705','63a5494f');
        mysqli_select_db($this->connection, 'heroku_f795c861b3c79e8');
    }

    
    function __destruct() {
        mysqli_close($this->connection);
    }
    
    public static function getConnection() {
        static $databasez = null;
        if($databasez === null) {
            $databasez = new Database();
        }
        return $databasez->connection;
    }
}


?>
