<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/rf.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UserReg</title>
</head>
<body>
<center>
    <form id="form1" name="form1" action="../funkce/regOwner.php" method="post">
        <div class="upBox">

            <div class="bigBox">
                <h2>Registrace uživatele</h2>
                <div id="close" onclick="location.href='../index.php'" class="close">+</div>
                <div class="smallBox">
                <input type="text" name="jmeno" id="jmeno" placeholder="Jméno" onkeyup="zobrazoverreg(1);check_platny()" required>
                <input type="text" name="prijmeni" id="prijmeni" placeholder="Příjmení" onkeyup="zobrazoverreg(2);check_platny()" required><br>
                <input type="number" name ="vek" id="vek" placeholder="Věk" onkeyup="zobrazoverreg(3);check_platny()" required><br>
                <input type="email" name="email1" id="email1" placeholder="E-mail" onkeyup="zobrazoverreg(5);check_platny()" required>
                <input type="email" name="email2" id="email2" placeholder="Potvrdit e-mail" onkeyup="zobrazoverreg(6);check_platny()" required><br>
                <input type="password" name="heslo1" id="heslo1" placeholder="Heslo" onkeyup="zobrazoverreg(9);check_platny()" required>
                <input type="password" name="heslo2" id="heslo2" placeholder="Potvrdit heslo" onkeyup="zobrazoverreg(10);check_platny()" required>
                </div>
                <div class="btn_div" id="btn_div"></div>
                <div><a style="color:rgb(130, 158, 173);" href="login.php">Máte účet?</a></div>
            </div>
        </div>
        <div class="lowBox">
            <span id="error"></span>
        </div>
    </form>
</center>
</body>
</html>