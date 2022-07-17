<?php
class regform
{
    public function __construct()
    {
        require_once "db.php";
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo "Nelze se připojit k MySQL: ";
            echo $e->getMessage();
        }
    }
    public function vratVsechnyUlice($nazev)  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT DISTINCT nazev FROM `ulice` WHERE `nazev` LIKE CONCAT(:nazev,'%') ORDER BY ulice.nazev ASC LIMIT 10");
            $stmt->bindParam(':nazev', $nazev);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
    public function vratVsechnyObce($nazev)  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT DISTINCT nazev FROM `obec` WHERE `nazev` LIKE CONCAT(:nazev,'%') ORDER BY obec.nazev ASC LIMIT 10");
            $stmt->bindParam(':nazev', $nazev);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
    public function kontrolaUlice($nazev){
        try {
            $stmt = $this->conn->prepare("");
            $stmt->bindParam(':nazev', $nazev);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
}