<?php
require '../conexion/conexion.php';
$id_filtro=$_GET['id'];

$paciente_id=$_GET['paciente_id'];

$sql_editar = "SELECT * FROM pacientes WHERE id=$paciente_id LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);
$codigo = $fila_editar['codigo'];

$sql_consulta = "SELECT * FROM consultas WHERE id=$id_filtro LIMIT 1";
$resultado_consulta = mysqli_query($conn, $sql_consulta);
$fila_consulta = mysqli_fetch_assoc($resultado_consulta);


$sql_detalle = "SELECT * FROM detalles_consultas WHERE consulta_id=$id_filtro LIMIT 1";
$resultado_detalle = mysqli_query($conn, $sql_detalle);
$fila_detalle = mysqli_fetch_assoc($resultado_detalle);



?> 

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header-blue text-center">
                    <h4 class="mb-0 text-white">
                        <i class="fas fa-edit me-2"></i> Estás editando la consulta <span class="text-white-50"><?php echo htmlspecialchars($id_filtro); ?></span>
                    </h4>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 text-primary fw-bold">Actualizar Consulta Médica</h5>

                    <form action="../php/actualizar_consulta.php" id="miFormulario" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($id_filtro); ?>">
                        <input type="hidden" name="paciente_id" value="<?php echo htmlspecialchars($paciente_id); ?>">

                        <div class="row mb-4">
                            <div class="col-lg-6 mx-auto">
                                <label for="doc" class="form-label">CÓDIGO DE PACIENTE</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <input type="text" class="form-control text-primary fw-bold" name="doc" id="doc" placeholder="Código de paciente" value="<?php echo htmlspecialchars($fila_editar['codigo']); ?>" readonly required>
                                </div>
                            </div>
                        </div>

                        <hr class="custom-hr">
                        <p class="text-uppercase text-center text-section-title">Datos del Paciente</p>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="nombre" class="form-label">NOMBRE</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control text-primary fw-bold" name="nombre" id="nombre" placeholder="Nombre del paciente" value="<?php echo htmlspecialchars($fila_editar['nombre']); ?>" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="apellidos" class="form-label">APELLIDOS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" class="form-control text-primary fw-bold" name="apellidos" id="apellidos" placeholder="Apellidos del paciente" value="<?php echo htmlspecialchars($fila_editar['apellidos']); ?>" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control text-primary fw-bold" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo htmlspecialchars($fila_editar['fecha_nacimiento']); ?>" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="dip" class="form-label">DIP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control text-primary fw-bold" name="dip" id="dip" placeholder="DIP del paciente" value="<?php echo htmlspecialchars($fila_editar['dip']); ?>" readonly required>
                                </div>
                            </div>
                        </div>

                        <hr class="custom-hr">
                        <p class="text-uppercase text-center text-section-title">Exploración Médica</p>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="peso" class="form-label">PESO</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso" value="<?php echo htmlspecialchars($fila_consulta['peso']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-weight-hanging"></i> kg</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="altura" class="form-label">ALTURA</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="altura" id="altura" placeholder="Altura" value="<?php echo htmlspecialchars($fila_consulta['altura']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i> cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="tension_arterial" class="form-label">TENSIÓN ARTERIAL</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tension_arterial" id="tension_arterial" placeholder="Ej: 120/80" value="<?php echo htmlspecialchars($fila_consulta['tension_arterial']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i> mmHg</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="pulso" class="form-label">PULSO</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pulso" id="pulso" placeholder="Latidos por minuto" value="<?php echo htmlspecialchars($fila_consulta['pulso']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-pulse"></i> bpm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="temperatura" class="form-label">TEMPERATURA</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" placeholder="Temperatura" value="<?php echo htmlspecialchars($fila_consulta['temperatura']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-thermometer-half"></i> °C</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="peo" class="form-label">SpO2</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="peo" id="peo" placeholder="Saturación de oxígeno" value="<?php echo htmlspecialchars($fila_consulta['PO2']); ?>" required>
                                    <span class="input-group-text"><i class="fas fa-lungs"></i> %</span>
                                </div>
                            </div>
                        </div>

                        <hr class="custom-hr">
                        <p class="text-uppercase text-center text-section-title">Otros Datos de Consulta</p>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="fecha" class="form-label">FECHA DE CONSULTA</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo htmlspecialchars($fila_consulta['fecha']); ?>" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="hora" class="form-label">HORA</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <input type="time" class="form-control" name="hora" id="hora" value="<?php echo htmlspecialchars($fila_consulta['hora']); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="precio" class="form-label">PRECIO</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de la consulta" value="<?php echo htmlspecialchars($fila_consulta['precio']); ?>" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="motivo" class="form-label">MOTIVO DE CONSULTA</label>
                                <textarea class="form-control" name="motivo" id="motivo" placeholder="Describe el motivo de la consulta" rows="3" required><?php echo htmlspecialchars($fila_consulta['motivo']); ?></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5">
                            <div class="col-auto d-flex gap-3">
                                <a href="../ENFERMERA/consultas.php" class="btn btn-danger btn-sm btn-custom-cancel">
                                    <i class="fas fa-times-circle me-2"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm btn-custom-save">
                                    <i class="fas fa-sync-alt me-2"></i> ACTUALIZAR CONSULTA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    // En un formulario de edición, la función buscar_datos() generalmente no es necesaria
    // porque los datos del paciente ya se cargan desde la base de datos al inicio.
    // Los campos del paciente son de solo lectura.
    // Si tu lógica requiere que el código del paciente sea editable y se pueda buscar,
    // entonces esta función sería relevante. De lo contrario, puedes omitirla o adaptarla.
    function buscar_datos() {
        // En este contexto de edición, el campo 'doc' (código de paciente) es de solo lectura.
        // La información del paciente ya ha sido cargada por PHP al inicio de la página.
        // Si necesitas esta función para algo más (ej. cambiar de paciente en la consulta),
        // deberías repensar la lógica y los permisos de edición.
        console.log("La función buscar_datos() se ejecutó, pero en un formulario de edición, los datos del paciente se cargan al inicio y son de solo lectura.");
    }
</script>