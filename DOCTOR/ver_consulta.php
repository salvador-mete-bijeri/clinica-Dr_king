<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM detalles_consultas WHERE consulta_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($detalle = $res->fetch_assoc()) {
        echo json_encode(['success' => true, 'detalle' => $detalle]);
    } else {
        echo json_encode(['success' => false]);
    }
}
