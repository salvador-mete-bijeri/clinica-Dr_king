<?php
require '../conexion/conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar y limpiar datos del formulario
    $consulta_id = mysqli_real_escape_string($conn, $_POST['consulta_id']);
    $observaciones = mysqli_real_escape_string($conn, $_POST['observaciones']);
    $cual_antecedente = trim($_POST['cual_antecedente']);
    $tratamiento_antecedente = trim($_POST['tratamiento_antecedente']);
    $grupo_sanguineo = mysqli_real_escape_string($conn, $_POST['grupo_sanguineo']);
    $medicamento_alergia = trim($_POST['medicamento_alergia']);
    $diagnostico_visita = trim($_POST['diagnostico_visita']);
    $tratamiento_visita = trim($_POST['tratamiento_visita']);
    $codigo_pac = mysqli_real_escape_string($conn, $_POST['codigo_pac']);

    // Condiciones para almacenar SI o NO
    $antecedentes_patologicos = empty($cual_antecedente) ? 'NO' : 'SI';
    $alergia_medi = empty($medicamento_alergia) ? 'NO' : $medicamento_alergia;
    $visita_medica = empty($diagnostico_visita) ? 'NO' : 'SI';

    // Si no hay visita médica, limpiamos los campos
    if ($visita_medica === 'NO') {
        $diagnostico_visita = '';
        $tratamiento_visita = '';
    }

    $fecha_actual = date('Y-m-d');

    // 1. Actualizar observaciones en la tabla consultas
    $updateConsulta = "UPDATE consultas SET observaciones = ? WHERE id = ?";
    $stmt1 = mysqli_prepare($conn, $updateConsulta);
    if ($stmt1) {
        mysqli_stmt_bind_param($stmt1, "si", $observaciones, $consulta_id);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
    } else {
        die("Error en la actualización de observaciones: " . mysqli_error($conn));
    }


    $consulta="SELECT * from consultas WHERE id=$consulta_id LIMIT 1";
    $resultado=mysqli_query($conn, $consulta);
    $fila=mysqli_fetch_assoc($resultado);

    $codigo= $fila['paciente_cod'];
    $fecha=$fila['fecha'];



    // 2. Actualizar la tabla detalles_consultas
    $updateDetalle = "UPDATE detalles_consultas SET 
        antecedentes_patologicos = ?, 
        grupo_sanguineo = ?, 
        alergia_medi = ?, 
        visita_medica = ?, 
        diagnostico = ?, 
        tratamiento = ?, 
        codigo_pac = ?, 
        fecha = ?, 
        antecedente = ?
        WHERE consulta_id = ?";

    $stmt2 = mysqli_prepare($conn, $updateDetalle);
    if ($stmt2) {
        mysqli_stmt_bind_param($stmt2, "sssssssssi",
            $antecedentes_patologicos,
            $grupo_sanguineo,
            $alergia_medi,
            $visita_medica,
            $diagnostico_visita,
            $tratamiento_visita,
            $codigo,
            $fecha,
            $cual_antecedente,
            $consulta_id
        );

        if (mysqli_stmt_execute($stmt2)) {
            header('Location: ../DOCTOR/consultas.php?mensaje=actualizado');
            exit;
        } else {
            echo "Error al actualizar detalles_consultas: " . mysqli_stmt_error($stmt2);
        }

        mysqli_stmt_close($stmt2);
    } else {
        die("Error al preparar actualización de detalles: " . mysqli_error($conn));
    }

} else {
    echo "Acceso no autorizado.";
}
?>
