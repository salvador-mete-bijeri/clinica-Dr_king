<?php
require '../conexion/conexion.php';

$dip_personal = $conn->real_escape_string($_POST['dip']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);

$genero = $conn->real_escape_string($_POST['genero']);

$direccion = $conn->real_escape_string($_POST['direccion']);

$correo = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$nacionalidad = $conn->real_escape_string($_POST['nacionalidad']);
$fecha = $conn->real_escape_string($_POST['fecha']);


$sql_personal= " SELECT * FROM personal where dip_personal='${dip_personal}' ";

$resultado_personal =mysqli_query($conn,$sql_personal);

$fila= mysqli_fetch_assoc($resultado_personal);
$numero=mysqli_num_rows($resultado_personal);

if($numero > 0)
{
    $dip_comparar= $fila['dip_personal'];
}else
{
    $dip_comparar=0;
}





if($dip_personal==$dip_comparar){

    header('Location: ../ADMINISTRADOR/personal.php?mensaje=igual');

}else{
    


    
$sql= "INSERT INTO personal (dip_personal,nombre,apellidos,fecha_nacimiento,sexo,direccion,email,telefono,nacionalidad,fecha_registro)
VALUES ('$dip_personal','$nombre','$apellidos','$fecha_nacimiento','$genero','$direccion','$correo','$telefono','$nacionalidad','$fecha')";

if($conn->query($sql)){
    $id=$conn->insert_id;
}

header('Location: ../ADMINISTRADOR/personal.php?mensaje=insertado'); 



}

?>
