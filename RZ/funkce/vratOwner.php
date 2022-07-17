<?php
session_start();
if ($_SESSION["prihlasen"]==false)  //když nejsem přihlášen
{
    unset($_SESSION['nickname']);
    header("Location: ../user/login.php");  //přesměrování
    exit();                               //doporučeno po přesměrování
}
include_once '../rz.class.php';
$rz = new rz();
$type=$_GET['type'];
$value=$_GET['value'];
switch($type){
    case 1:
        $SPZs=$rz->vratSpzFromValue($value);
        foreach($SPZs as $spz) {
            $owner=$rz->vratOwner($spz->owner_id);
            $car=$rz->vratCarFromSpzId($spz->id);
            echo("
            <div class='result-box'> 
                 <table style='border-spacing: 15px;'>
                        <tr>
                            <th class='res-main' colspan='2'><h2 style='padding-right: 10px;'>$spz->value</h2></th>
                        </tr>
                        <tr>
                            <th class='res-label'>Jméno:</th>
                            <th class='res-value'>".$owner[0]->jmeno." ".$owner[0]->prijmeni."</th>
                        </tr>
                        <tr>
                            <th class='res-label'>Věk:</th>
                            <th class='res-value'>".$owner[0]->age."</th>
                        </tr>
                        <tr>
                            <th class='res-label'>Auto:</th>
                            ");
                            if(empty($car)){
                                echo("<th class='res-value'>Není registováno</th>");
                            }
                            else {
                                echo("<th class='res-value' > ".$rz->vratCarMake($car[0]->car_make_id)." ".$rz->vratCarModel($car[0]->car_model_id)." </th >");
                                }
            echo("
                        </tr>
                        <tr>
                            <th class='res-label'>Kontakt:</th>
                            <th class='res-value'>".$owner[0]->mail."</th>
                        </tr>
                 </table>
            </div>
        
        ");
        }

        break;
    case 2:
       $owners=$rz->vratOwnerFromJmeno($value);

        foreach($owners as $owner){
            $cars=$rz->vratOwnerCarsFromID($owner->id);

            echo("
                <div class='result-box' id='owner_$owner->id'> 
                    <table style='border-spacing: 10px; text-align: center;'>
                        <tr>
                            <th class='res-main' colspan='2'><h2 style='padding-right: 10px;'>$owner->jmeno $owner->prijmeni</h2></th>
                        </tr>
                        <tr>
                            <th class='res-label'>Věk:</th>
                            <th class='res-value'>".$owner->age."</th>
                        </tr> 
                        <tr>
                            <th class='res-label'>Kontakt:</th>
                            <th class='res-value'>".$owner->mail."</th>
                        </tr>
                        
                        <tr>
                            <th colspan='2' style='border-top: 1px rgb(133, 163, 178) solid; padding-top: 3px;' class='res-label'>Auta:</th>
                        </tr>
                        ");
                        if(empty($cars)){
                            echo("<th colspan='2' class='res-value'>Žádná</th>");
                        }
                        else {
                            foreach ($cars as $car) {
                                echo("
                                <tr>
                                    <th  class='res-value'> " . $rz->vratCarMake($car->car_make_id) . " " . $rz->vratCarModel($car->car_model_id) . "</th>
                                    <th class='res-value' style='padding-left:80px;'>".$rz->vratCarSPZ($car->spz_id)[0]->value."</th>
                                    
                                </tr>
                                
                                
                            ");
                            }
                        }
                        echo("
                                 <tr>
                                    <th colspan='2'  class='res-value'><button class='btn_2' onclick='showDeleteForm($owner->id, 3)'><img class='delImg' src='../assets/trash.png' ></button></th>
                                </tr>
                    </table>
                </div>
            ");
        }
        break;
}


