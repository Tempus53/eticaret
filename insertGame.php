<?php
    include "dbInfo.php";
    if(isset($_POST["gameCode"])&&isset($_POST["name"])&&isset($_POST["p_code"])&&isset($_POST["price"])&&isset($_POST["about"]))
    {
        $gameCode = $_POST["gameCode"];
        $name = $_POST["name"];
        $p_code = $_POST["p_code"];
        $price = $_POST["price"];
        $about = $_POST["about"];
        $control_query = "select * from games where gameCode='$gameCode';";
        $control_result = $conn->query($control_query);
        if($control_result->num_rows > 0)
        {
            echo 'code';
        }
        else{
            $ins_game_query = "insert into games(gameCode,name,p_code,price,about,discount) values
            ('$gameCode','$name','$p_code',$price,'$about',0);";
            $insert_game = $conn->query($ins_game_query);
            echo 'success';
        }
      
    }
