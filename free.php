<?php
session_start();
if (isset($_POST["gameCode"])) 
{
    $add_gameCode = $_POST["gameCode"];
    foreach ($_SESSION["myCart"] as $row) 
    {
        if ($row["gameCode"] == $add_gameCode) 
        {
            $_SESSION["myCart"]["adet"] += 1;
        }
    }
    print_r($_SESSION["myCart"]);
}
else{
    echo 'post edilmedi';
}
