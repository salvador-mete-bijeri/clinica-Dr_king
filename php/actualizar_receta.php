<?php


require '../conexion/conexion.php';

$id_receta = $conn->real_escape_string($_POST['id_receta']);
$receta =$conn->real_escape_string($_POST['receta']);
$instrucciones =$conn->real_escape_string($_POST['instrucciones']);
$id_diagnostico =$conn->real_escape_string($_POST['diagnostico']);
$comentario =$conn->real_escape_string($_POST['comentario']);



$sql= "UPDATE  receta SET descripcion_receta='$receta',instrucciones_receta='$instrucciones' ,comentario='$comentario' ,id_diagnostico='$id_diagnostico'  WHERE id_receta=$id_receta";


if($conn->query($sql)){
    $id=$conn->insert_id;
}else{
    echo "error de insersion";
}

header('Location: ../DOCTOR/recetas.php?mensaje=actualizado'); 






?>