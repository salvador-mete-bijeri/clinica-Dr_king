<?php
require '../conexion/conexion.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mes'])) {
    $mes = $_POST['mes']; // Ejemplo: 2025-06





$nombre_mes = $mes;





    // FILTRAR CONSULTAS
    $consultas_total = 0;
    $consultas_html = '';
    $stmt = $conn->prepare("SELECT * FROM consultas WHERE fecha LIKE ?");
    $like_mes = "$mes%";
    $stmt->bind_param("s", $like_mes);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($fila = $result->fetch_assoc()) {
        $consultas_total += $fila['precio'];

        $consultas_html .= '<div class="card mb-2 p-2 shadow-sm">';

        $consultas_html .= "<p><strong>Paciente:</strong> {$fila['paciente_cod']} | <strong>Precio:</strong> {$fila['precio']} FCFA  | <strong>Mes:</strong> {$nombre_mes}</p>";

        $consultas_html .= '</div>';
    }

    // FILTRAR PAGOS + JOIN CON tipo_prueba
    $pruebas_total = 0;
    $pruebas_html = '';
    $stmt2 = $conn->prepare("SELECT tipo_prueba.nombre_prueba, pagos.*
FROM pagos
JOIN tipo_prueba ON pagos.id_tipo_prueba = tipo_prueba.id
      WHERE pagos.fecha LIKE ?");
    $stmt2->bind_param("s", $like_mes);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    while ($fila = $result2->fetch_assoc()) {
        $pruebas_total += $fila['cantidad'];

        $pruebas_html .= '<div class="card mb-2 p-2 shadow-sm">';
        $pruebas_html .= "<p><strong>Prueba:</strong> {$fila['nombre_prueba']} | <strong>Cantidad:</strong> {$fila['cantidad']} FCFA      | <strong>Mes:</strong> {$nombre_mes}  </p>";
        $pruebas_html .= '</div>';
    }

    // RESPUESTA EN JSON
    echo json_encode([
        'consultas_html' => $consultas_html,
        'pruebas_html' => $pruebas_html,
        'consultas_total' => $consultas_total,
        'pruebas_total' => $pruebas_total
    ]);
    exit;
} else {
    echo json_encode(['error' => 'Petición inválida']);
}
