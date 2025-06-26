<?php

require '../conexion/conexion.php';

// Recogemos los datos que SÍ vienen del formulario
$cod = $conn->real_escape_string($_POST['doc']);
$id = $conn->real_escape_string($_POST['id']); // id del paciente ya existente
$peso = $conn->real_escape_string($_POST['peso']);
$altura = $conn->real_escape_string($_POST['altura']);
$tension_arterial = $conn->real_escape_string($_POST['tension_arterial']);
$pulso = $conn->real_escape_string($_POST['pulso']);
$temperatura = $conn->real_escape_string($_POST['temperatura']);
$peo = $conn->real_escape_string($_POST['peo']); // Ahora es SpO2
$fecha = $conn->real_escape_string($_POST['fecha']); // Fecha de la consulta
$hora = $conn->real_escape_string($_POST['hora']); // Hora de la consulta
$precio = $conn->real_escape_string($_POST['precio']);
$motivo = $conn->real_escape_string($_POST['motivo']);

// **IMPORTANTE**: Los campos 'hea' y 'observacion' fueron eliminados del formulario,
// por lo tanto, no deben ser recogidos aquí ni insertados en la base de datos.
// Si tu tabla 'consultas' aún espera estos campos, deberás ajustarla o asignarles un valor predeterminado (ej. NULL).
// Por ahora, los quito de la sentencia INSERT.

// Sentencia SQL para insertar la consulta en la tabla 'consultas'
// Asegúrate de que los nombres de las columnas en tu tabla 'consultas' coincidan con esto
$sql = "INSERT INTO consultas (peso, altura, tension_arterial, pulso, temperatura, PO2, paciente_id, paciente_cod, fecha, hora, precio, motivo)
VALUES ('$peso', '$altura', '$tension_arterial', '$pulso', '$temperatura', '$peo', $id, '$cod', '$fecha', '$hora', '$precio', '$motivo')";

if($conn->query($sql)){
    // Si la inserción de la consulta principal fue exitosa
    // $id_consulta_insertada = $conn->insert_id; // Puedes obtener el ID de la consulta recién insertada si lo necesitas

    // **IMPORTANTE**: Se elimina toda la lógica de inserción en 'detalles_consultas'
    // porque los campos asociados (antecedentes, alergias, visitas) fueron eliminados del formulario.
    // También se elimina el bloque final de inserción de pacientes, ya que no corresponde a este archivo.

    // Redirigir a la página de consultas con un mensaje de éxito
    header('Location: ../ENFERMERA/consultas.php?mensaje=insertado');
    exit(); // Siempre usa exit() después de header() para evitar que el script siga ejecutándose
} else {
    // Si hubo un error en la inserción de la consulta principal
    echo "Error al guardar la consulta: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();

?>