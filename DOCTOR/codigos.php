<?php
require '../conexion/conexion.php';

// session_start();
// if(!isset($_SESSION['usuario'])){

//   header('Location:../login.php');
// }


if(isset($_POST['buscar']))
{
   
    $doc = $_POST['doc'];


    
    $valores= array();
    $valores['existe'] = "0";

    $resultados=mysqli_query ($conn, " SELECT * FROM pacientes WHERE codigo='$doc' LIMIT 1");
    while($consulta= mysqli_fetch_assoc($resultados))

    {


        $valores['existe']= "1";
        $valores['nombre']=$consulta['nombre'];
        $valores['apellidos']=$consulta['apellidos'];
        $valores['dip']=$consulta['dip'];
        $valores['fecha_nacimiento']=$consulta['fecha_nacimiento'];
        $valores['id']=$consulta['id'];
       
       

        $valores= json_encode($valores);
        echo $valores;
    }

}

?>

