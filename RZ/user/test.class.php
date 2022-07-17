<?php

class test
{
    public $conn;
    /**
     * Konstruktor se připojí k DB ASW
     */
    public function __construct()
    {
        require_once "db.php";
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try
        {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e)
        {
            echo "Nelze se připojit k MySQL: ";  echo $e->getMessage();
        }
    }
}