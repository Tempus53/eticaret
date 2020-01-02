<?php
session_start();
include "dbInfo.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_query = "select * from users where username='$username' and password = '$password';";
    $login_result = $conn->query($login_query);
    if ($login_result->num_rows > 0) {
        $userInfo = mysqli_fetch_assoc($login_result);
        $_SESSION['username'] = $userInfo['username'];
        $_SESSION['name'] = $userInfo['name'];
        $_SESSION['surname'] = $userInfo['surname'];
        $_SESSION['email'] = $userInfo['email'];
        $cart_query = "select gameCode,name,price,(select name from platform where p_code = mycart_games.p_code)as platform,count(*)as adet,discount from mycart_games where username='$username' group by name order by adet desc;";
        $cart_result = $conn->query($cart_query);
        if (!isset($_SESSION['myCart']))
            {
                $_SESSION['myCart'] = array();
            }
            else{
                foreach ($_SESSION["myCart"] as $row){
                    $add_gameCode = $row['gameCode'];
                    $add_cart_query = "insert into cart(gameCode,username) values ('$add_gameCode','$username');";
                    $add_cart = $conn->query($add_cart_query);
                }
            }
        while ($cart_items = mysqli_fetch_array($cart_result)) {
            array_push($_SESSION['myCart'], $cart_items);
        }
        echo "success";
    } else {
        echo "fail";
    }
    exit();
} else {
    echo '<script>alert("post edilmedi");</script>';
}
