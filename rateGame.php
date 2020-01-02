<?php
session_start();
include "dbInfo.php";
if (isset($_POST["rate"]) && isset($_SESSION["username"]) && isset($_POST["gameCode"])) {
    $rate = $_POST["rate"];
    $username = $_SESSION["username"];
    $gameCode = $_POST["gameCode"];
    $control_query = "select gameCode from myGames where username = '$username' and gameCode='$gameCode';";
    $control_result = $conn->query($control_query);
    if ($control_result->num_rows > 0) {
        $rate_control_query = "select * from rating where username='$username' and gameCode='$gameCode';";
        $rate_control_result = $conn->query($rate_control_query);
        if ($rate_control_result->num_rows > 0) {
            $rate_update_query = "update rating set rate=$rate where username='$username' and gameCode='$gameCode';";
            $rate_update_result = $conn->query($rate_update_query);
            echo 'updated';
        } else {
            $rate_query = "insert into rating(username,gameCode,rate) values ('$username','$gameCode',$rate);";
            $rate_result = $conn->query($rate_query);
            echo 'success';
        }
    } else {
        echo 'donthaveGame';
    }
} else {
    if (!isset($_SESSION["username"]))
        echo 'notLogin';
    else
        echo 'posterror';
}
