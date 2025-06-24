<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar datos del formulario
    $codigo  = $_POST['codigo'];
    $fecha   = $_POST['fecha']; // ← Fecha única para todas las pruebas
    $pruebas = $_POST['pruebas'] ?? [];
    $tipos   = $_POST['tipo_prueba'] ?? [];
    $precios = $_POST['precio_prueba'] ?? [];


 



  

    // Verificar si se han seleccionado pruebas
    if (count($pruebas) > 0) {
        $conn->begin_transaction();

        try {
            // 1. Marcar pruebas como pagadas
            $placeholders = implode(',', array_fill(0, count($pruebas), '?'));
            $stmt = $conn->prepare("UPDATE prueba SET pagado = 1 WHERE id_prueba IN ($placeholders)");
            $stmt->bind_param(str_repeat('i', count($pruebas)), ...$pruebas);
            $stmt->execute();
            $stmt->close();

            // 2. Insertar los pagos
            $stmtInsert = $conn->prepare("INSERT INTO pagos (cantidad, id_prueba, fecha, id_tipo_prueba) VALUES (?, ?, ?, ?)");

            foreach ($pruebas as $id_prueba) {
                $precio = $precios[$id_prueba];
                $tipo   = $tipos[$id_prueba];





                $stmtInsert->bind_param("iisi", $precio, $id_prueba, $fecha, $tipo);
                $stmtInsert->execute();
            }

            $stmtInsert->close();
            $conn->commit();

            header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pagado');
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=error');
            exit;
        }
    } else {
        header('Location: ../ADMINISTRADOR/pruebas.php?mensaje=pendientes');
        exit;
    }

    $conn->close();
}
?>
