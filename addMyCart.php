<?php
include "dbInfo.php";
session_start();
if (isset($_POST["gameCode"])) {
    $gameCode = $_POST["gameCode"];
    foreach ($_SESSION["myCart"] as &$item) {
        if ($item["gameCode"] == $gameCode) {
            $item["adet"] = intval($item["adet"]) + 1;
        }
    }
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $add_query = "insert into cart(gameCode,username) values ('$gameCode','$username');";
        $add_cart = $conn->query($add_query);
    }
    echo 'addComplete';
}
