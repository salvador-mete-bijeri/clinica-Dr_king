<?php



require '../conexion/conexion.php';

$id_prueba = $conn->real_escape_string($_POST['id_prueba']);
$resultado = $conn->real_escape_string($_POST['resultado']);
$fecha = $conn->real_escape_string($_POST['fecha']);

// obteniedo la hora y la fecha actual


date_default_timezone_set('America/Mexico_City');

$fecha_actual =date('Y-m-d');




$estado = 1;




$sql= "UPDATE  prueba SET resultado='$resultado',estado='$estado' WHERE id_prueba=$id_prueba";


if($conn->query($sql)){
    $id=$conn->insert_id;

    header('Location: ../LABORATORIO/pruebas.php?mensaje=actualizado'); 

}else{
    echo "error de insersion";
}





