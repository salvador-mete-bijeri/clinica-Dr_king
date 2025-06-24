<?php



require '../conexion/conexion.php';

$doc = $conn->real_escape_string($_POST['doc']);
$id = $conn->real_escape_string($_POST['id']);
$fecha = $conn->real_escape_string($_POST['fecha']);

// obteniedo la hora y la fecha actual




    $sql = "INSERT INTO citas (paciente,codigo,fecha)
 VALUES ('$id','$doc','$fecha')";

    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        header('Location: ../DOCTOR/citas.php?mensaje=insertado');
    } else {
        echo "error de insersion";
    }
