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
        echo "<div class='list-group'>";
        while ($row = $resultado->fetch_assoc()) {
             $id = $row['id_prueba'];
            $tipo = $row['id_tipo_prueba'];
            $precio = $row['precio'];
            $nombre = $row['nombre_prueba'];
            echo "<label class='list-group-item'>";
            echo "<input type='checkbox' 
                         class='form-check-input me-2 prueba-checkbox' 
                         name='pruebas[]' 
                         value='$id' 
                         data-precio='$precio' 
                         data-id_tipo='$tipo' 
                         checked>";
            echo "$nombre - <strong>" . number_format($precio, 2) . " FCFA</strong>";

            // También puedes incluir campos ocultos si necesitas enviar id_tipo_prueba junto a cada id_prueba
            echo "<input type='hidden' name='tipo_prueba[$id]' value='$tipo'>";
            echo "<input type='hidden' name='precio_prueba[$id]' value='$precio'>";
            echo "</label>";
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-info'>No hay pruebas pendientes.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
