<?php
class login
{
    public $conn;
    /**
     * Konstruktor se připojí k DB
     */
    public function __construct()
    {
        require_once "../db.php";
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
    /**
     * function loginOK
     * return username / false
     */
    public function loginOK($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(id) AS log FROM `owner` WHERE `jmeno` = :username AND `password` = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
                //tabulka SQL se uloží do objektu $dotaz
            $dotaz = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($dotaz[0]->log == 1)
            {
                return true;
            }
            else
                {
                return false;
            }
           // return $dotaz; //změníme
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky: ";
            echo $e->getMessage();
            return false;
        }
    }
    public function userExists($jmeno)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `owner` WHERE jmeno='" . $jmeno . "'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
    public function registruj($jmeno,$prijmeni,$heslo,$age,$email){
        try {
            $stmt = $this->conn->prepare("INSERT INTO `owner` (`id`, `jmeno`, `prijmeni`,`password`, `age`,`mail`) VALUES (NULL, :jmeno,:prijmeni,:password,:age,:mail)");
            $stmt->bindParam(':jmeno', $jmeno);
            $stmt->bindParam(':prijmeni', $prijmeni);
            $stmt->bindParam(':password', $heslo);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':mail', $email);


            var_dump($stmt);
            $stmt->execute();

            return true;
            // return $dotaz; //změníme
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky: ";
            echo $e->getMessage();
            return false;
        }

    }
}