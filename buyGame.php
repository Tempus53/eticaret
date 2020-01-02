<?php
    include "dbInfo.php";
    session_start();
    if(isset($_POST["gameCode"]) && isset($_SESSION["username"]))
    {
        $gameCode = $_POST["gameCode"];
        $username = $_SESSION["username"];
        $gameKey_query = "select * from activationCodes where gameCode='$gameCode' limit 0,1;";
        $gameKey_result = $conn->query($gameKey_query);
        $gameKey_all = mysqli_fetch_assoc($gameKey_result);
        $gameKey = $gameKey_all["activationCode"];
        $buy_query = "insert into myGames(gameKod,username,gameKey) values ($gameCode,$username,$gameKey);";
    }
?>