<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["name"]);
    unset($_SESSION["surname"]);
    unset($_SESSION["email"]);
    unset($_SESSION["myCart"]);
    header("Location: index.php");
?>