<?php
session_start();
include_once 'login.class.php';
$login = new login();
$_SESSION["prihlasen"] = false;
if (isset($_POST["prihlas"])) {
    $username = ucfirst(htmlspecialchars($_POST["nameInput"]));
    $password = htmlspecialchars($_POST["passInput"]);
    $userExists=$login->userExists($username);
    if(!empty($userExists)){
        if ($login->loginOK($username, $password)) {
            $_SESSION["nickname"] = $username;
            $_SESSION["userID"] = $userExists[0]->id;
            $_SESSION["prihlasen"] = true;
            header("Location: profile.php");
            exit();                             //doporučeno po přesměrování - ukončí script
        }
    }

    else{echo("user do not exists");}
}
if($_SESSION["prihlasen"] ==false)
{
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/login.css">
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script src="../js/index.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div class="bigBox">
        <h2>Login</h2>
        <div id="close" onclick="location.href='../index.php'" class="close">+</div>
        <div class="smallBox">
            <form method="POST" action="">
            <div><label for="nameInput"></label><input  onkeyup="loginEntered()" placeholder="Vaše první jméno" id="nameInput" name="nameInput" type="text"></div>
            <div><label for="passInput"></label><input  onkeyup="loginEntered()" placeholder="Heslo" id="passInput" name="passInput" type="password"></div>
            <div class="btn_div" id="btn_div"></div>
            </form>
            <div><a style="color:rgb(130, 158, 173);" href="ownerReg.php">Nemáte účet?</a></div>
        </div>

    </div>
</body>
</html>
    <?php
}
?>