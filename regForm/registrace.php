<?php
include_once 'regform.class.php';
$regform=new regform();

?>

<!DOCTYPE html>
<html lang='cs'>
<head>
    <title>Registrační formulář</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rf.css">
    <script src="rf.js"></script>
    <meta charset='utf-8'>
</head>
<body>
<center>
<form id="form1" name="form1">
    <div class="upBox">
        <h1>Registrační formulář</h1>
        <div class="inputs">
        <input type="text" name="jmeno" id="jmeno" placeholder="Jméno" onkeyup="zobrazoverreg(1)" required>
        <input type="text" name="prijmeni" id="prijmeni" placeholder="Příjmení" onkeyup="zobrazoverreg(2)" required>
        <input type="number" name ="vek" id="vek" placeholder="Věk" onkeyup="zobrazoverreg(3)" required>
        <input type="date" name="datum" id="datum" placeholder="Datum narození" required>
        <input type="tel" name="cislo" id="cislo" placeholder="Telefonní číslo" onkeyup="zobrazoverreg(4)" required maxlength="9">
        <input type="email" name="email1" id="email1" placeholder="E-mail" onkeyup="zobrazoverreg(5)" required>
        <input type="email" name="email2" id="email2" placeholder="Potvrdit e-mail" onkeyup="zobrazoverreg(6)" required>
        <input type="url" name="web" id="web" placeholder="Web" onkeyup="zobrazoverreg(7)" required>
        <input type="text" name="username" id="username" placeholder="Username" onkeyup="zobrazoverreg(8)" required>
        <input type="password" name="heslo1" id="heslo1" placeholder="Heslo" onkeyup="zobrazoverreg(9)" required>
        <input type="password" name="heslo2" id="heslo2" placeholder="Potvrdit heslo" onkeyup="zobrazoverreg(10)" required>
        <input list="ulice" id="cesta" name="cesta" placeholder="Ulice" onkeyup="uliceAJAX(this.value)">
            <datalist id="ulice">
            </datalist>
        <input list="obec" id="cesta" name="cesta" placeholder="Obec" onkeyup="obecAJAX(this.value)">
            <datalist id="obec">
            </datalist>
        </div>
    </div>
    <div class="lowBox">
        <span id="error"></span>
        <button id="overreg" type="button" onclick="sent();">Registruj</button>
    </div>
</form>
</center>
</body>
</html>