<?php
require '../conexion/conexion.php';
$codigo = $_POST['codigo'];
$fecha = $_POST['fecha'];

$sql = "SELECT prueba.id_prueba, tipo_prueba.nombre_prueba
        FROM prueba
        JOIN pacientes ON prueba.paciente = pacientes.id
        JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
        WHERE pacientes.codigo = ? AND prueba.fecha = ?
        AND (prueba.resultado IS NULL OR prueba.resultado = '')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigo, $fecha);
$stmt->execute();
$res = $stmt->get_result();

$html = '';

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $html .= '
        <div class="col-md-6">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
              <h6 class="card-title text-primary">
                <i class="bi bi-flask me-2"></i>' . htmlspecialchars($row['nombre_prueba']) . '
              </h6>
              <input 
                type="text" 
                name="resultados[' . $row['id_prueba'] . ']" 
                class="form-control" 
                placeholder="Escribe el resultado aquí..." 
                required>
            </div>
          </div>
        </div>';
    }
} else {
    $html = '<div class="col-12 text-center text-success">
                <i class="bi bi-check-circle-fill fs-2"></i><br>
                <strong>Todas las pruebas ya tienen resultado.</strong>
             </div>';
}

echo $html;
