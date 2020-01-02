<?php
include "dbInfo.php";
session_start();
    if(isset($_SESSION["username"]) && isset($_POST["commentGameCode"]) && isset($_POST["comment"]))
    {
        $username=$_SESSION["username"];
        $gameCode = $_POST["commentGameCode"];
        $comment = $_POST["comment"];
        $control_query = "select username from comments where username='$username' and gameCode='$gameCode';";
        $control_result = $conn->query($control_query);
        if($control_result->num_rows > 0)
        {
            $update_query = "update comments set comment='$comment' where username='$username' and gameCode='$gameCode';";
            $update_result = $conn->query($update_query);
            echo 'updated';
        }
        else{
            $insert_query = "insert into comments(username,gameCode,comment) values ('$username','$gameCode','$comment');";
            $insert_result = $conn->query($insert_query);
            echo 'success';
        }
    }
    else {
        echo 'posterror';
    }
?>