<?php

class rz
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


//RZ------------------------------------------------
    function rzExists($spz)
    {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS pocet FROM `spz` WHERE `value` like '".$spz."'");
            $stmt->execute();
            $all= $stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->pocet;


        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//RETRNY NA REG----------------------------------------------------------------------------------------------
    function vratTypes(){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_type`");

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratMakes($typeID)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_make` WHERE id_car_type = :typeID");
            $stmt->bindParam(":typeID",$typeID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratModel($makeID)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_model` WHERE id_car_make = :makeID");
            $stmt->bindParam(":makeID",$makeID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratGeneration($modelID)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_generation` WHERE id_car_model = :modelID");
            $stmt->bindParam(":modelID",$modelID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratSeries($generationID)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_serie` WHERE id_car_generation = :generationID");
            $stmt->bindParam(":generationID", $generationID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratTrims($serieID)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_trim` WHERE id_car_serie = :serieID");
            $stmt->bindParam(":serieID", $serieID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratSPZID($spz){
        try {
            $stmt = $this->conn->prepare("SELECT id AS 'id' FROM `spz` WHERE `value` = '".$spz."'");
            $stmt->execute();
            $d=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $d[0]->id;
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratOwnerCarsFromID($owner_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car` WHERE `owner_id` = :id");
            $stmt->bindParam(":id",$owner_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
//ZAPIS--------------------------------------------------------------------------------------------
    function zapisSPZ($value,$owner_id, $isCustom){
        try {
            $stmt = $this->conn->prepare("INSERT INTO `spz` (`id`, `value`,`isCustom`, `registration_date`, `owner_id`) VALUES (NULL,'".$value."',:isCustom, DEFAULT,:owner_id)");
            var_dump($stmt);
            $stmt->bindParam(":isCustom", $isCustom);
            $stmt->bindParam(":owner_id", $owner_id);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
    function zapisCar($owner_id, $spz,$type, $make,$model,$generation, $series,$trim)
    {
        $spz_id= $this->vratSPZID($spz);
        try {
            $stmt = $this->conn->prepare("INSERT INTO `car` (`id`, `owner_id`, `spz_id`,`registration_date`, `car_type_id`,`car_make_id`,`car_model_id`,`car_generation_id`,`car_serie_id`,`car_trim_id`) VALUES (NULL, :owner_id,:spz_id,DEFAULT,:car_type_id,:car_make_id,:car_model_id,:car_generation_id,:car_serie_id,:trim_id)");
            $stmt->bindParam(":owner_id",$owner_id);
            $stmt->bindParam(":spz_id",$spz_id);
            $stmt->bindParam(":car_type_id",$type);
            $stmt->bindParam(":car_make_id",$make);
            $stmt->bindParam(":car_model_id",$model);
            $stmt->bindParam(":car_generation_id",$generation);
            $stmt->bindParam(":car_serie_id",$series);
$stmt->bindParam(":trim_id",$trim);





            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo "---model:  ".$model."  -----";
            echo $e->getMessage();
            return false;
        }
    }




//RETURNY HODNOT-----------------------------------------------------------------------------------
    function vratCarMake($make_id){
        try {
            $stmt = $this->conn->prepare("SELECT name FROM `car_make` WHERE `id_car_make` = :id");
            $stmt->bindParam(":id",$make_id);
            $stmt->execute();
            $all=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->name;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarModel($model_id){
        try {
            $stmt = $this->conn->prepare("SELECT name FROM `car_model` WHERE `id_car_model` = :id");
            $stmt->bindParam(":id",$model_id);
            $stmt->execute();
            $all=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->name;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarSPZ($car_spz_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `spz` WHERE `id` = :id");
            $stmt->bindParam(":id",$car_spz_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarGeneration($car_gen_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car_generation` WHERE `id_car_generation` = :id");
            $stmt->bindParam(":id",$car_gen_id);
            $stmt->execute();
            $all=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->name;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarSerie($serie_id){
        try {
            $stmt = $this->conn->prepare("SELECT name FROM `car_serie` WHERE `id_car_serie` = :id");
            $stmt->bindParam(":id",$serie_id);
            $stmt->execute();
            $all=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->name;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarTrim($trim_id){
        try {
            $stmt = $this->conn->prepare("SELECT name FROM `car_trim` WHERE `id_car_trim` = :id");
            $stmt->bindParam(":id",$trim_id);
            $stmt->execute();
            $all=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $all[0]->name;

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratOwner($owner_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `owner` WHERE `id` = :id");
            $stmt->bindParam(":id",$owner_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratOwnerSPZ($owner_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `spz` WHERE `owner_id` = :id");
            $stmt->bindParam(":id",$owner_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratSPZvalue($spzID){
        try {
            $stmt = $this->conn->prepare("SELECT value AS 'value' FROM `spz` WHERE `id` = :id");
            $stmt->bindParam(":id",$spzID);
            $stmt->execute();
            $d=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $d[0]->value;
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarPodleSPZ($spz_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car` WHERE `spz_id` = :id");
            $stmt->bindParam(":id",$spz_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratCarPodleID($car_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car` WHERE `id` = :id");
            $stmt->bindParam(":id",$car_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function spzRegisteredID($spz_id){
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as pocet FROM `car` WHERE `spz_id` = :id");
            $stmt->bindParam(":id",$spz_id);
            $stmt->execute();
            $d= $stmt->fetchAll(PDO::FETCH_OBJ);
            if($d[0]->pocet==0){
                return false;
            }
            else{
                return true;
            }
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function spzRegisteredValue($spz_value){
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as pocet FROM `spz` WHERE `value` = :value");
            $stmt->bindParam(":value",$spz_value);
            $stmt->execute();
            $d= $stmt->fetchAll(PDO::FETCH_OBJ);
            if($d[0]->pocet==0){
                return false;
            }
            else{
                return true;
            }
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

    function vratSpzFromValue($spz_value){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `spz` WHERE `value` like '%$spz_value%' ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
    function vratOwnerFromJmeno($value){

        if (strpos($value, ' ') !== false) {
            $arrayString= explode(" ", $value);
            $jmeno=$arrayString[0];
            $prijmeni=$arrayString[1];

            try {
                $stmt = $this->conn->prepare("SELECT * FROM `owner` WHERE `jmeno` like '%$jmeno%' AND `prijmeni` like '%$prijmeni%'");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);

            } catch (PDOException $e) {
                echo "Chyba databáze: ";
                echo $e->getMessage();
                return false;
            }
        }
        else{
            $jmeno=$value;
            $prijmeni=$value;
            try {
                $stmt = $this->conn->prepare("SELECT * FROM `owner` WHERE `jmeno` like '%$jmeno%' UNION SELECT * FROM `owner` WHERE `prijmeni` like '%$prijmeni%'");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);

            } catch (PDOException $e) {
                echo "Chyba databáze: ";
                echo $e->getMessage();
                return false;
            }
        }

    }

    function vratCarFromSpzId($spz_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `car` WHERE `spz_id` = $spz_id ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }

//DELETE----------------------------------------------------------------------------------------------
    function deleteCar($car_id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM `car` WHERE `id` = :id");
            $stmt->bindParam(":id",$car_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
    function deleteSPZ($spz_id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM `spz` WHERE `id` = :id");
            $stmt->bindParam(":id",$spz_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }
    function deleteUser($user_id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM `owner` WHERE `id` = :id");
            $stmt->bindParam(":id",$user_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Chyba databáze: ";
            echo $e->getMessage();
            return false;
        }
    }



}