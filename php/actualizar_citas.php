<?php


require '../conexion/conexion.php';

$id= $conn->real_escape_string($_POST['id']);
$fecha =$conn->real_escape_string($_POST['fecha']);


$sql= "UPDATE  citas SET fecha='$fecha' WHERE id=$id";


if($conn->query($sql)){
    $id=$conn->insert_id;
}else{
    echo "error de insersion";
}

header('Location: ../DOCTOR/citas.php?mensaje=actualizado'); 






?>