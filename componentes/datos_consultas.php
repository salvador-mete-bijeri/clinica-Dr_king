<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Conexión
require '../conexion/conexion.php';

// Obtener valor del buscador de DataTables
$search = $_GET['search']['value'] ?? '';

// Limpiar espacios y convertir a minúsculas
$search = strtolower(trim($search));

$data = [];

if (!empty($search)) {
    // Usamos LOWER en la consulta para hacerla insensible a mayúsculas
    $stmt = $conn->prepare("SELECT * FROM consultas WHERE REPLACE(LOWER(paciente_cod), ' ', '') LIKE ?");
    $like = "%" . str_replace(' ', '', $search) . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row["id"],
            "paciente_id" => $row["paciente_id"],
            "paciente_cod" => $row["paciente_cod"],
            "peso" => $row["peso"],
            "altura" => $row["altura"],
            "tension_arterial" => $row["tension_arterial"],
            "pulso" => $row["pulso"],
            "temperatura" => $row["temperatura"],
            "PO2" => $row["PO2"],
            "fecha" => $row["fecha"],
            "hora" => $row["hora"],
            "precio" => $row["precio"]
        ];
    }
}

echo json_encode(["data" => $data]);
