<?php 
$servername = "localhost";         
$user = "root";           
$pass = "toor";     
$dbname = "p2w";
$conn = new mysqli($servername,$user,$pass,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo 'Die caliıştı connection failed';
}


function discount($price,$discount){
    $price = $price - $price * ($discount / 100) ;
    return intval($price);
}
?>