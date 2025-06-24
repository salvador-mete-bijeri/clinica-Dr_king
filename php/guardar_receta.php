<?php



require '../conexion/conexion.php';

$idconsulta = $conn->real_escape_string($_POST['id_consulta']);
$paciente_id = $conn->real_escape_string($_POST['paciente_id']);
$dip = $conn->real_escape_string($_POST['dip']);
$reseta = $conn->real_escape_string($_POST['receta']);
$instrucciones = $conn->real_escape_string($_POST['instrucciones']);
$fecha = $conn->real_escape_string($_POST['fecha']);
$diagnostico = $conn->real_escape_string($_POST['diagnostico']);
$comentario = $conn->real_escape_string($_POST['comentario']);

 // obteniedo la hora y la fecha actual





 $sql="INSERT INTO receta (descripcion_receta,id_consulta,paciente,instrucciones_receta,fecha,id_diagnostico,codigo_pac,comentario)
VALUES ('$reseta','$idconsulta','$paciente_id','$instrucciones','$fecha','$diagnostico','$dip','$comentario')";
 
if($conn->query($sql)){
    $id=$conn->insert_id;
    header('Location: ../DOCTOR/recetas.php?mensaje=insertado');
}else{
    echo "error de insersion";
}





       
                         
                 
                
 




?>