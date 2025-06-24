<?php



require '../conexion/conexion.php';





$id_prueba = $_GET['id_prueba'];

$id_tipo_prueba = $_GET['id_tipo_prueba'];
$precio = $_GET['precio'];


$codigo = $_GET['codigo'];




$sql_prueba = "SELECT * FROM pagos WHERE id_prueba=$id_prueba LIMIT 1";
$resultado_prueba = mysqli_query($conn, $sql_prueba);
$pago2=mysqli_num_rows($resultado_prueba);

if($pago2>0){

    header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pagado2');

}else{



    



    // obteniedo la hora y la fecha actual

date_default_timezone_set('America/Mexico_City');

$fecha_actual =date('Y-m-d');




$pagado = 1;



$sql = "UPDATE  prueba SET pagado='$pagado' WHERE id_prueba=$id_prueba";


if ($conn->query($sql)) {





    $sql = "INSERT INTO pagos (cantidad,id_prueba,fecha,id_tipo_prueba)
 VALUES ('$precio','$id_prueba','$fecha_actual','$id_tipo_prueba')";

    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pagado');
    } else {
        echo "error de insersion";
    }

} else {
    echo "error al actualizar la prueba";
}



  






}









