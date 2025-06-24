<?php

require '../conexion/conexion.php';

$id = $conn->real_escape_string($_POST['id']);
$dip = $conn->real_escape_string($_POST['dip']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
$genero = $conn->real_escape_string($_POST['genero']);
$dip = $conn->real_escape_string($_POST['dip']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$tutor = $conn->real_escape_string($_POST['tutor']);
$fecha_registro = $conn->real_escape_string($_POST['fecha_registro']);

$sql= "UPDATE  pacientes SET dip='$dip', nombre='$nombre',apellidos='$apellidos',fecha_nacimiento='$fecha_nacimiento',sexo='$genero',direccion='$direccion',
email='$email',tel='$telefono',tutor='$tutor',fecha='$fecha_registro' WHERE id=$id";


if($conn->query($sql)){

    header('Location: ../ENFERMERA/pacientes.php?mensaje=actualizado');  
   
}else{
    echo "error al actualizar el paciente";
}

 



?>