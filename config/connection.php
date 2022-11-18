<?php


class Database{
    
    private $connection;
    
    public function __construct(){
        $this->connection = mysqli_connect("localhost", "root", "[]x?,U*<VkcbFRF,WM]T", "easy-learning");
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
}

?>