<?php
    require '../conexion/conexion.php';



// ACTIVAMOS MOSTRAR ERRORES
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CABECERA JSON
header('Content-Type: application/json');



// INICIALIZAMOS VARIABLES
$response = [
    'consultas_html' => '',
    'consultas_total' => 0,
    'pruebas_html' => '',
    'pruebas_total' => 0
];

// VALIDAMOS FECHA
if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
    echo json_encode(['error' => 'No se recibió fecha']);
    exit;
}

$fecha = trim($_POST['fecha']);

// ---------------------- CONSULTAS ------------------------
$html_consultas = '';
$total_consultas = 0;

$sql_consultas = "SELECT paciente_cod, precio FROM consultas WHERE fecha = ?";
$stmt1 = $conn->prepare($sql_consultas);
$stmt1->bind_param("s", $fecha);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {

        $html_consultas .= '<div class="card mb-2 p-2 shadow-sm">';
        $html_consultas .= "<p><strong>Paciente:</strong> {$row['paciente_cod']} | <strong>Precio:</strong> {$row['precio']} FCFA  | {$fecha}</p>";
        $html_consultas .= '</div>';
        $total_consultas += floatval($row['precio']);
    }
} else {
    $html_consultas = '<p class="text-muted text-center">No hay consultas registradas.</p>';
}

$response['consultas_html'] = $html_consultas;
$response['consultas_total'] = $total_consultas;

// ---------------------- PAGOS ------------------------
$html_pruebas = '';
$total_pruebas = 0;

$sql_pagos = "SELECT tipo_prueba.nombre_prueba, pagos.*
FROM pagos
JOIN tipo_prueba ON pagos.id_tipo_prueba = tipo_prueba.id
WHERE pagos.fecha = ?";
$stmt2 = $conn->prepare($sql_pagos);
$stmt2->bind_param("s", $fecha);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        
         $html_pruebas .= '<div class="card mb-2 p-2 shadow-sm">';
        $html_pruebas .= "<p><strong>Prueba:</strong> {$row['nombre_prueba']} | <strong>Cantidad:</strong> {$row['cantidad']} FCFA | {$fecha}</p>";
       $html_pruebas .= '</div>';
        $total_pruebas += floatval($row['cantidad']);
    }
} else {
    $html_pruebas = '<p class="text-muted text-center">No hay pruebas registradas.</p>';
}

$response['pruebas_html'] = $html_pruebas;
$response['pruebas_total'] = $total_pruebas;

// ---------------------- RESPUESTA FINAL ------------------------
echo json_encode($response);
exit;
