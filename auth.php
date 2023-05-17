<?php

$email = $_POST['email'];
$passwd = $_POST['passwd'];

if ($email == "citywintoday@email.com" && $passwd == "123") {
    session_start();

    $_SESSION['auth'] = true;
    $_SESSION['name'] = "City Win Today";

    header("location: /home.php");

    exit;
}

header("location: /login.php?err=Email or password incorrect!");

?>