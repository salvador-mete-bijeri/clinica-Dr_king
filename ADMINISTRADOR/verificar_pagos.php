<?php

require '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST['codigo'];
    $fecha = $_POST['fecha'];

    $query = "SELECT 
                prueba.id_tipo_prueba,prueba.id_prueba,
                tipo_prueba.nombre_prueba, 
                tipo_prueba.precio
              FROM prueba
              LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
              WHERE TRIM(prueba.codigo_pac) = ? 
                AND DATE(prueba.fecha) = ? 
                AND prueba.pagado = 0";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $codigo, $fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<h4 class='P-3'>🧾 Lista de Pruebas Pendientes</h4>";
        echo "<table class='table table-bordered P-3'><thead><tr><th>Prueba</th><th>Precio</th></tr></thead><tbody>";

        $total = 0;
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr><td>{$row['nombre_prueba']}</td><td>" . number_format($row['precio'], 2) . " FCFA</td></tr>";
            $total += $row['precio'];
            $id_prueba=$row['id_prueba'];
            $id_tipo_prueba=$row['id_tipo_prueba'];
            $precio=$row['precio'];

           
        }

        echo "</tbody></table>";
        echo "<h5 class='text-end P-3'> Total: <strong >" . number_format($total, 2) . " FCFA</strong></h5>";

        // Botón PAGAR AHORA
        echo "
        <div class='text-end P-3'>
            <form action='../php/procesar_pago.php' method='post'>
                <input type='hidden' name='id_prueba' value='" . htmlspecialchars($id_prueba) . "'>
                <input type='hidden' name='id_tipo_prueba' value='" . htmlspecialchars($id_tipo_prueba) . "'>
                 <input type='hidden' name='precio' value='" . htmlspecialchars($precio) . "'>
                 <input type='hidden' name='codigo' value='" . $codigo . "'>
                  <input type='hidden' name='fecha' value='" . $fecha . "'>
                <input type='hidden' name='total' value='" . $total . "'>
                <button type='submit' class='btn btn-success'>💳 PAGAR AHORA</button>
            </form>
        </div>";

    } else {
        echo "<div class='alert alert-warning P-3'>No se encontraron pruebas pendientes para ese paciente y fecha.</div>";
    }
}
?>
