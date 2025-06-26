<?php
header('Content-Type: application/json'); // Indicar que la respuesta será JSON

require '../conexion/conexion.php'; // Asegúrate de que la ruta sea correcta

$response = ['success' => false, 'message' => ''];

if (isset($_GET['id_consulta']) && isset($_GET['paciente_id'])) {
    $id_consulta = mysqli_real_escape_string($conn, $_GET['id_consulta']);
    $paciente_id = mysqli_real_escape_string($conn, $_GET['paciente_id']);

    // Consultar datos del paciente
    $sql_paciente = "SELECT codigo, nombre, apellidos, fecha_nacimiento, dip FROM pacientes WHERE id = '$paciente_id' LIMIT 1";
    $resultado_paciente = mysqli_query($conn, $sql_paciente);
    $paciente_data = mysqli_fetch_assoc($resultado_paciente);

    // Consultar datos de la consulta
    // Asegúrate de que los nombres de las columnas coincidan con tu tabla 'consultas'
    $sql_consulta = "SELECT peso, altura, tension_arterial, pulso, temperatura, PO2, fecha, hora, precio, motivo FROM consultas WHERE id = '$id_consulta' AND paciente_id = '$paciente_id' LIMIT 1";
    $resultado_consulta = mysqli_query($conn, $sql_consulta);
    $consulta_data = mysqli_fetch_assoc($resultado_consulta);

    if ($paciente_data && $consulta_data) {
        $response['success'] = true;
        $response['paciente'] = $paciente_data;
        $response['consulta'] = $consulta_data;
    } else {
        $response['message'] = 'No se encontraron los datos del paciente o de la consulta.';
    }
} else {
    $response['message'] = 'Parámetros ID de consulta o paciente faltantes.';
}

echo json_encode($response); // Devolver la respuesta en formato JSON

mysqli_close($conn); // Cerrar la conexión a la base de datos
?>