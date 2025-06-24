<?php


require '../conexion/conexion.php';




$dip_personal = $conn->real_escape_string($_POST['dip_personal']);
$nombe_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
$password_usuario = $conn->real_escape_string($_POST['password']);
$rol = $conn->real_escape_string($_POST['rol']);


$sql_personal= " SELECT * FROM personal where dip_personal='${dip_personal}' ";

$resultado_personal =mysqli_query($conn,$sql_personal);

$fila= mysqli_fetch_assoc($resultado_personal);

$dip_comparar= $fila['dip_personal'];

if($dip_personal==$dip_comparar){

    if($rol==""){
        echo 'eroor no selecciono un rol';

    }else{

        $passwordHash = password_hash($password_usuario, PASSWORD_DEFAULT);


        $sql= "INSERT INTO usuarios (nombre_usuario,password_usuario,id_rol,dip_personal)
VALUES ('$nombe_usuario','$passwordHash','$rol','$dip_personal')";





if($conn->query($sql)){
    $id=$conn->insert_id;
}else{
   

    header('Location: ../ADMINISTRADOR/usuarios.php?mensaje=insertado'); 
}

header('Location: ../ADMINISTRADOR/usuarios.php?mensaje=error'); 





    }




}else{
    header('Location: ../ADMINISTRADOR/usuarios.php?mensaje=diferente');
}















?>