<?php
require '../conexion/conexion.php';
$response = ['success' => false];

if (isset($_POST['resultados']) && is_array($_POST['resultados'])) {
    $todoCorrecto = true;

    foreach ($_POST['resultados'] as $id_prueba => $resultado) {
        // Actualizar resultado y estado = 1
        $sql = "UPDATE prueba SET resultado = ?, estado = 1 WHERE id_prueba = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $resultado, $id_prueba);
            if (!$stmt->execute()) {
                $todoCorrecto = false;
            }
        } else {
            $todoCorrecto = false;
        }
    }

    $response['success'] = $todoCorrecto;
}

header('Content-Type: application/json');
echo json_encode($response);
