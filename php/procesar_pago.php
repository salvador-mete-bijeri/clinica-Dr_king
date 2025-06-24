<?php
require '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST['codigo'];
    $fecha = $_POST['fecha'];

    // 1. Obtener todas las pruebas pendientes de pago
    $query = "SELECT prueba.id_prueba AS id_prueba, prueba.id_tipo_prueba, tipo_prueba.precio
              FROM prueba
              LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
              WHERE prueba.codigo_pac = ? AND prueba.fecha = ? AND prueba.pagado = 0";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $codigo, $fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Iniciar transacción
        $conn->begin_transaction();

        try {
            while ($row = $resultado->fetch_assoc()) {
                $id_prueba = $row['id_prueba'];
                $id_tipo_prueba = $row['id_tipo_prueba'];
                $precio = $row['precio'];

                // 2. Marcar la prueba como pagada
                $update = $conn->prepare("UPDATE prueba SET pagado = 1 WHERE id_prueba = ?");
                $update->bind_param("i", $id_prueba);
                $update->execute();

                // 3. Insertar en tabla precio
                $insert = $conn->prepare("INSERT INTO pagos (cantidad, id_prueba, fecha, id_tipo_prueba) VALUES (?, ?, ?, ?)");
                $insert->bind_param("diss", $precio, $id_prueba, $fecha, $id_tipo_prueba);
                $insert->execute();
            }

            // Confirmar los cambios
            $conn->commit();

             header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pagado');
        } catch (Exception $e) {
            $conn->rollback();
            
            header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=error');
        }
    } else {
        echo "<div class='alert alert-info P-3'>No hay pruebas pendientes para procesar.</div>";

        header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pendientes');
    }

    $stmt->close();
    $conn->close();
}
?>
