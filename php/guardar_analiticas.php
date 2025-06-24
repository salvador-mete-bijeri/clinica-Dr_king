<?php



require '../conexion/conexion.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$precio = $conn->real_escape_string($_POST['precio']);

// obteniedo la hora y la fecha actual




    $sql = "INSERT INTO tipo_prueba (nombre_prueba,precio)
 VALUES ('$nombre','$precio')";

    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        header('Location: ../ADMINISTRADOR/analiticas.php?mensaje=insertado');
    } else {
        echo "error de insersion";
    }
