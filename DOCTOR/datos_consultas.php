<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require '../conexion/conexion.php';

$search = strtolower(trim($_GET['search']['value'] ?? ''));

// Si no hay búsqueda, no devolvemos nada
if (empty($search)) {
    echo json_encode([
        "draw" => intval($_GET['draw']),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => []
    ]);
    exit;
}

// Buscar por paciente_cod ignorando espacios y mayúsculas
$sql = "SELECT * FROM consultas WHERE REPLACE(LOWER(paciente_cod), ' ', '') LIKE ?";
$stmt = $conn->prepare($sql);
$like = '%' . str_replace(' ', '', $search) . '%';
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "draw" => intval($_GET['draw']),
    "recordsTotal" => count($data),
    "recordsFiltered" => count($data),
    "data" => $data
]);
