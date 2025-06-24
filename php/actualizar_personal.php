<?php


require '../conexion/conexion.php';

$dip_personal = $conn->real_escape_string($_POST['dip']);

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
$genero = $conn->real_escape_string($_POST['genero']);
$direccion = $conn->real_escape_string($_POST['direccion']);

$email = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$nacionalidad = $conn->real_escape_string($_POST['nacionalidad']);
$fecha = $conn->real_escape_string($_POST['fecha_registro']);



$sql= "UPDATE  personal SET nombre='$nombre',apellidos='$apellidos',fecha_nacimiento='$fecha_nacimiento',sexo='$genero',direccion='$direccion',email='$email',telefono='$telefono',nacionalidad='$nacionalidad',fecha_registro='$fecha' WHERE dip_personal=$dip_personal";


if($conn->query($sql)){
    $id=$conn->insert_id;

    
header('Location: ../ADMINISTRADOR/personal.php?mensaje=actualizado'); 



}else{
    echo "error de insersion";
}

?>