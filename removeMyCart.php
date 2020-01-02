<?php
include "dbInfo.php";
session_start();
if (isset($_POST["gameCode"])) {
    $gameCode = $_POST["gameCode"];
    $i=0;
    foreach ($_SESSION["myCart"] as &$item) {
        if ($item["gameCode"] == $gameCode) {
            if (intval($item["adet"]) != 0) {
                $item["adet"] = intval($item["adet"]) - 1;
                if (isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];
                    $delete_query = "delete from cart where username='$username' and gameCode='$gameCode' limit 1;";
                    $delete_cart = $conn->query($delete_query);
                }
                if (intval($item["adet"]) == 0) {
                    array_splice($_SESSION["myCart"], $i, 1);
                    $i--;
                }
            }
        }
        $i++;
    }
    echo "deleted";
} else {
    echo "NoPost";
}
