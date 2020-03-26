<?php 

class DbConnect
{
    private $conn;

    function __construct() {}

    function connect()
    {
        require_once 'constants.php';

        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) 
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        return $this->conn;
    }
}

?>