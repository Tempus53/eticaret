<?php
include "dbInfo.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['surname'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username_control = "select * from users where username='$username';";
    $email_control = "select * from users where email='$email';";
    $username_result = $conn->query($username_control);
    $email_result = $conn->query($email_control);
    if ($username_result->num_rows > 0) {
        echo "usernameExists";
    } else if ($email_result->num_rows > 0) {
        echo "emailExists";
    } else {
        $query = "insert into users(username,password,name,surname,email) values ('$username','$password','$name','$surname','$email');";
        $insert = $conn->query($query);
        echo '<script>alert("Kayıt Başarılı")</script>';
    }
    exit();
} else {
    echo '<script>alert("post edilmedi");</script>';
}
