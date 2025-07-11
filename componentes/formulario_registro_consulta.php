<?php
require '../conexion/conexion.php';
$sql_numero = "SELECT * FROM pacientes ORDER BY id DESC LIMIT 1";
$resultado_numero = mysqli_query($conn, $sql_numero);
$fila_numero = mysqli_fetch_assoc($resultado_numero);
$id_numero = $fila_numero['id'];


if ($id_numero > 0) {

    $id_ultimo = $id_numero + 1;
    $codigo = 'CP-' . $id_ultimo;
} else {

    $codigo = 'CP-1';
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10 mx-auto"> <div class="card shadow-lg border-0 rounded-lg"> <div class="card-header bg-gradient-primary pb-0 pt-3"> <div class="d-flex align-items-center">
                        <p class="mb-0 text-white fs-5 fw-bold p-2">Información del Paciente</p> </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Registro de Consulta Médica</h5> 
                   <form action="../php/guardar_consulta23.php" id="miFormulario" method="post" enctype="multipart/form-data">

                        <div class="row mb-4">
                            <div class="col-lg-6 mx-auto">
                                <label for="doc" class="form-label">CÓDIGO DE PACIENTE</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <input type="text" class="form-control" name="doc" id="doc" placeholder="Introduce código" value="" required onblur="buscar_datos();">
                                </div>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>

                        <hr class="custom-hr">
                        <p class="text-uppercase text-center text-section-title">Datos del Paciente</p>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <input type="hidden" name="idpaciente" id="idpaciente">
                                <label for="nombre" class="form-label">NOMBRE</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Introduce el nombre" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="apellidos" class="form-label">APELLIDOS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Introduce el apellido" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="dip" class="form-label">DIP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" name="dip" id="dip" placeholder="Introduce el DIP" readonly required>
                                </div>
                            </div>
                        </div>

                        <hr class="custom-hr">
                        <p class="text-uppercase text-center text-section-title">Exploración Médica</p>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="peso" class="form-label">PESO</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso" required>
                                    <span class="input-group-text"><i class="fas fa-weight-hanging"></i> kg</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="altura" class="form-label">ALTURA</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="altura" id="altura" placeholder="Altura" required>
                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i> cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="tension_arterial" class="form-label">TENSIÓN ARTERIAL</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tension_arterial" id="tension_arterial" placeholder="Ej: 120/80" required>
                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i> S/D</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="pulso" class="form-label">PULSO</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pulso" id="pulso" placeholder="Latidos por minuto" required>
                                    <span class="input-group-text"><i class="fas fa-pulse"></i> bpm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="temperatura" class="form-label">TEMPERATURA</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" placeholder="Temperatura" required>
                                    <span class="input-group-text"><i class="fas fa-thermometer-half"></i> °C</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="peo" class="form-label">SpO2</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="peo" id="peo" placeholder="Saturación de oxígeno" required>
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
                                    <input type="date" class="form-control" name="fecha" id="fecha" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="hora" class="form-label">HORA</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <input type="time" class="form-control" name="hora" id="hora" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="precio" class="form-label">PRECIO</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-xaf-sign"></i></span>
                                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de la consulta" min="500" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="motivo" class="form-label">MOTIVO DE CONSULTA</label>
                                <textarea class="form-control" name="motivo" id="motivo" placeholder="Describe el motivo de la consulta" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5">
                            <div class="col-auto d-flex gap-3"> <a href="../ENFERMERA/consultas.php" class="btn btn-danger btn-sm btn-custom-cancel">
                                    <i class="fas fa-times-circle me-2"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm btn-custom-save">
                                    <i class="fas fa-save me-2"></i> GUARDAR CONSULTA
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
    function buscar_datos() {
        doc = $("#doc").val();

        var parametros = {
            "buscar": "1",
            "doc": doc
        };

        $.ajax({
            data: parametros,
            dataType: 'json',
            url: 'codigos.php',
            type: 'POST',
            error: function() {
                alert("No se encontró este código de paciente.");
            },
            success: function(valores) {
                if (valores) {
                    $("#nombre").val(valores.nombre);
                    $("#apellidos").val(valores.apellidos);
                    $("#fecha_nacimiento").val(valores.fecha_nacimiento);
                    $("#dip").val(valores.dip);
                    $("#id").val(valores.id);
                } else {
                    alert("No se encontraron datos para este código.");
                    // Clear fields if no data is found
                    $("#nombre").val('');
                    $("#apellidos").val('');
                    $("#fecha_nacimiento").val('');
                    $("#dip").val('');
                    $("#id").val('');
                }
            }
        });
    }
</script>
