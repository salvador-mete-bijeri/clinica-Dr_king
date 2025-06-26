<?php
// Incluir el archivo de conexión a la base de datos
require '../conexion/conexion.php';

// Verificar si la solicitud es de tipo POST (es decir, si el formulario fue enviado)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger los datos del formulario
    // Es crucial sanitizar y validar todos los datos de entrada para prevenir ataques SQL injection
    // y otros problemas de seguridad. Aquí usamos mysqli_real_escape_string.

    $id_consulta = mysqli_real_escape_string($conn, $_POST['id_consulta']);
    // No necesitamos el paciente_id aquí para la actualización directa de la consulta,
    // pero lo pasamos por si acaso para futuras lógicas.
    $paciente_id = mysqli_real_escape_string($conn, $_POST['paciente_id']);

    $peso = mysqli_real_escape_string($conn, $_POST['peso']);
    $altura = mysqli_real_escape_string($conn, $_POST['altura']);
    $tension_arterial = mysqli_real_escape_string($conn, $_POST['tension_arterial']);
    $pulso = mysqli_real_escape_string($conn, $_POST['pulso']);
    $temperatura = mysqli_real_escape_string($conn, $_POST['temperatura']);
    $spo2 = mysqli_real_escape_string($conn, $_POST['peo']); // 'peo' es el nombre del campo SpO2 en tu formulario
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $hora = mysqli_real_escape_string($conn, $_POST['hora']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $motivo = mysqli_real_escape_string($conn, $_POST['motivo']);

    // Construir la consulta SQL UPDATE
    // Asegúrate de que los nombres de las columnas coincidan con tu tabla 'consultas'
    $sql_update = "UPDATE consultas SET
                    peso = '$peso',
                    altura = '$altura',
                    tension_arterial = '$tension_arterial',
                    pulso = '$pulso',
                    temperatura = '$temperatura',
                    PO2 = '$spo2',
                    fecha = '$fecha',
                    hora = '$hora',
                    precio = '$precio',
                    motivo = '$motivo'
                    WHERE id = $id_consulta";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql_update)) {
        // Redirigir al usuario a una página de éxito o a la lista de consultas
        // Puedes pasar un mensaje de éxito en la URL si lo deseas
        header("Location: ../ENFERMERA/consultas.php?status=success_update");
        exit(); // Es importante salir después de una redirección
    } else {
        // Manejar el error si la consulta falla
        echo "Error al actualizar la consulta: " . mysqli_error($conn);
        // Podrías redirigir a una página de error o mostrar un mensaje más amigable
        // header("Location: ../ENFERMERA/error.php?status=error_update");
        // exit();
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

} else {
    // Si alguien intenta acceder a este archivo directamente sin enviar el formulario
    echo "Acceso no autorizado.";
    header("Location: ../ENFERMERA/consultas.php"); // O redirigir a una página principal
    exit();
}
?>