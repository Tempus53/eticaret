<?php
session_start();
include "dbInfo.php";
if (!isset($_SESSION['myCart']))
    $_SESSION['myCart'] = array();

$inCart = false;
if (isset($_POST['gameCode'])) {
    $gameCode = $_POST['gameCode'];
    foreach ($_SESSION["myCart"] as &$item) {
        if($item["gameCode"]==$gameCode){
            $item["adet"] = intval($item["adet"]) + 1;
            $inCart=true;
        }
    }
    if ($inCart) {
        echo 'success';
    } else {
        $game_query = "select gameCode,name,(select name from platform where games.p_code=p_code)as platform,price,count(gameCode)as adet,discount from games where gameCode='$gameCode';";
        $game_result = $conn->query($game_query);
        $game_info = mysqli_fetch_assoc($game_result);
        array_push($_SESSION['myCart'], $game_info);
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $add_query = "insert into cart(gameCode,username) values ('$gameCode','$username');";
            $add_Cart = $conn->query($add_query);
        }
        echo 'success';
    }
} else {
    echo 'POST ERROR';
}
