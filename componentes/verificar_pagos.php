<?php
require '../conexion/conexion.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

    if (empty($codigo) || empty($fecha)) {
        echo "<div class='alert alert-danger'>Código de paciente y fecha son requeridos.</div>";
        exit;
    }

    $query = "SELECT 
                prueba.id_tipo_prueba, 
                tipo_prueba.nombre_prueba, 
                tipo_prueba.precio
              FROM prueba
              LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
              WHERE TRIM(prueba.codigo_pac) = ? 
                AND DATE(prueba.fecha) = ? 
                AND prueba.pagado = 0";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $codigo, $fecha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<h4>🧾 Lista de Pruebas Pendientes</h4>";
            echo "<table class='table table-bordered'><thead><tr><th>Prueba</th><th>Precio</th></tr></thead><tbody>";

            $total = 0;
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row['nombre_prueba']) . "</td><td>" . number_format($row['precio'], 2) . " FCFA</td></tr>";
                $total += $row['precio'];
            }

            echo "</tbody></table>";
            echo "<h5 class='text-end'>💰 Total: <strong>" . number_format($total, 2) . " FCFA</strong></h5>";
        } else {
            echo "<div class='alert alert-warning'>No se encontraron pruebas pendientes para ese paciente y fecha.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la consulta.</div>";
    }
}
?>

