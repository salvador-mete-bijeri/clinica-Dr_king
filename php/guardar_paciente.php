<?php


require '../conexion/conexion.php';

$sql = "SELECT * FROM pacientes ORDER BY id DESC LIMIT 1";
$resultado = mysqli_query($conn, $sql);
$fila = mysqli_fetch_assoc($resultado);
$id = $fila['id'];
echo $id;

if ($id > 0) {

    $id_ultimo = $id + 1;
    $codigo = 'CP-' . $id_ultimo;

} else {

    $codigo = 'CP-1';
}



$dip_personal = $conn->real_escape_string($_POST['dip']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);

$telefono = $conn->real_escape_string($_POST['telefono']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$tutor = $conn->real_escape_string($_POST['tutor']);
$genero = $conn->real_escape_string($_POST['genero']);

$email = $conn->real_escape_string($_POST['email']);
$fecha_registro = $conn->real_escape_string($_POST['fecha_registro']);











$sql = "INSERT INTO pacientes (dip,nombre,apellidos,fecha_nacimiento,sexo,direccion,email,tel,tutor,fecha,codigo)
VALUES ('$dip_personal','$nombre','$apellidos','$fecha_nacimiento','$genero','$direccion','$email','$telefono','$tutor','$fecha_registro','$codigo')";





if ($conn->query($sql)) {
    $id = $conn->insert_id;
    header('Location: ../ENFERMERA/pacientes.php');
} else {
    echo "error de insersion";
}
