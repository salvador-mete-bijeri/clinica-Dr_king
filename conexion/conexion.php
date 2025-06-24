<?php
$conn= new mysqli("127.0.0.1","root", "","dr_king");
$conn->set_charset("utf8");


if($conn->connect_error){
    die("eror de conexion" . $conn->connect_error);
}


?>