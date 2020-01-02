<?php
    include "dbInfo.php";
    session_start();
    if(isset($_POST["gameCode"])&&isset($_POST["discount"]))
    {
        $dis= $_POST["discount"];
        $gameCode = $_POST["gameCode"];
        $dis_query = "update games set discount=$dis where gameCode='$gameCode';";
        $dis_result = $conn->query($dis_query);
        echo 'success';
    }
    else
        echo 'posterror';
?>