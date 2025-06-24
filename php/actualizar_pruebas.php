<?php


require '../conexion/conexion.php';

$id= $conn->real_escape_string($_POST['id']);
$nombre= $conn->real_escape_string($_POST['nombre']);
$precio =$conn->real_escape_string($_POST['precio']);


$sql= "UPDATE  tipo_prueba SET nombre_prueba='$nombre',precio='$precio' WHERE id=$id";


if($conn->query($sql)){
    $id=$conn->insert_id;
}else{
    echo "error de insersion";
}

header('Location: ../ADMINISTRADOR/tipo_pruebas.php?mensaje=actualizado'); 






?>