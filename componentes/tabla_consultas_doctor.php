<!-- End Navbar -->
<?php

require '../conexion/conexion.php';

$sqlPacientes = "SELECT * FROM consultas";

$pacientes = $conn->query($sqlPacientes);



// iniciando la sesion




?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">



                    <form action="../reportes//historialmedico_dia.php" method="post" target="_blank">
                        <div class="row  justify-content-center">

                            <div class="col-md-2">

                                <input type="text" class="form-control" name="codigo" id="codigo" value="CP-" required>
                            </div>

                            <div class="col-md-2">


                                <input type="date" class="form-control" name="fecha" id="fecha" required>

                            </div>

                            <div class="col-md-2 ">


                                <button type="submit" class="btn btn-warning btn-sm"> Imprimir </button>

                            </div>

                        </div>
                    </form>











                </div>




                <!-- alerta -->

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'insertado') {
                    ?>

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> su registro ha tenido Exito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>



                <!-- alerta -->

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'codigo') {
                    ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> no hay registros en el codigo y la fecha.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>



                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'actualizado') {
                    ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> su registro ha sido actualizado.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>




                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'igual') {
                    ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> el DIP ya corresponde a un paciente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>










                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-1">








                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <th>CODIGO</th>
                                <th>PESO</th>
                                <th>ALTURA</th>
                                <th>TENSION ARTERIAL</th>
                                <th>PULSO</th>
                                <th>TEMPERATURA</th>
                                <th>PO2</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                                <th>PRECIO</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




   










    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: 'datos_consultas.php',
                    type: 'GET'
                },
                columns: [{
                    data: 'paciente_cod'
                },
                {
                    data: 'peso'
                },
                {
                    data: 'altura'
                },
                {
                    data: 'tension_arterial'
                },
                {
                    data: 'pulso'
                },
                {
                    data: 'temperatura'
                },
                {
                    data: 'PO2'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'hora'
                },
                {
                    data: 'precio'
                },
                {
                    data: null,
                    render: function (data) {
                        return `
             

                       <button class="btn btn-sm btn-primary ver-consulta" 
        data-id="${data.id}"
        data-paciente_id="${data.paciente_id}"
        data-cod="${data.paciente_cod}"
        data-peso="${data.peso}"
        data-altura="${data.altura}"
        data-tension="${data.tension_arterial}"
        data-pulso="${data.pulso}"
        data-temp="${data.temperatura}"
        data-po2="${data.PO2}"
        data-fecha="${data.fecha}"
        data-hora="${data.hora}"
        data-precio="${data.precio}"
      >Ver</button>
                        <a href="../DOCTOR/analisis.php?id_consulta=${data.id}&codigo=${data.paciente_cod}&id_paciente=${data.paciente_id}&fecha=${data.fecha}" class="btn btn-sm btn-warning">PRUEBAS</a>
                        <a href="../DOCTOR/registrar_receta.php?id=${data.id}&codigo=${data.paciente_cod}&paciente_id=${data.paciente_id}&fecha=${data.fecha}" class="btn btn-sm btn-success">RECETAS</a>
<button type="button" class="btn btn-primary ver-consulta" data-bs-toggle="modal" data-bs-target="#historialModal"

data-id="${data.id}"
        data-paciente_id="${data.paciente_id}"
        data-cod="${data.paciente_cod}"
        data-peso="${data.peso}"
        data-altura="${data.altura}"
        data-tension="${data.tension_arterial}"
        data-pulso="${data.pulso}"
        data-temp="${data.temperatura}"
        data-po2="${data.PO2}"
        data-fecha="${data.fecha}"
        data-hora="${data.hora}"
        data-precio="${data.precio}"

>
  Añadir Historial Médico
</button>


            `;
                    }
                }
                ],
                language: {
                    emptyTable: "Use el buscador para encontrar un código"
                }
            });
        });



        $(document).on('click', '.ver-consulta', function () {
            const id = $(this).data('id');

            // Datos básicos desde atributos del botón
            $('#verCod').text($(this).data('cod'));
            $('#verPeso').text($(this).data('peso'));
            $('#verAltura').text($(this).data('altura'));
            $('#verTension').text($(this).data('tension'));
            $('#verPulso').text($(this).data('pulso'));
            $('#verTemp').text($(this).data('temp'));
            $('#verPo2').text($(this).data('po2'));
            $('#verFecha').text($(this).data('fecha'));
            $('#verHora').text($(this).data('hora'));
            $('#verPrecio').text($(this).data('precio'));

            // Consulta los datos clínicos adicionales
            $.ajax({
                url: 'ver_consulta.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.success && response.detalle) {
                        $('#verPatologicos').text(response.detalle.antecedentes_patologicos || '-');
                        $('#verSangre').text(response.detalle.grupo_sanguineo || '-');
                        $('#verAlergia').text(response.detalle.alergia_medi || '-');
                        $('#verVisita').text(response.detalle.visita_medica === 'SI' ? 'Sí' : 'No');
                        $('#verDiagnostico').text(response.detalle.diagnostico || '-');
                        $('#verTratamiento').text(response.detalle.tratamiento || '-');
                        $('#verAntecedente').text(response.detalle.antecedente || '-');
                    } else {
                        $('#verPatologicos, #verSangre, #verAlergia, #verVisita, #verDiagnostico, #verTratamiento, #verAntecedente').text('-');
                    }

                    $('#modalConsulta').modal('show');
                },
                error: function () {
                    alert('Error al cargar detalle de consulta');
                }
            });
        });
    </script>





<!-- Modal Responsive -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-lg">
    <div class="modal-content shadow rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="historialModalLabel">Formulario de Historial Médico</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>


<!-- Bloque de datos del paciente/consulta -->
<div class="bg-light rounded shadow-sm p-4 mb-4 border border-2 border-primary-subtle">
  <h5 class="text-center text-primary mb-4">
    <i class="bi bi-person-circle me-2"></i>Datos del Paciente / Consulta
  </h5>

  <div class="row g-3 text-secondary small">
    <div class="col-md-4"><strong><i class="bi bi-upc-scan me-1"></i> Código:</strong> <span id="verCod"></span></div>
    <div class="col-md-4"><strong><i class="bi bi-speedometer2 me-1"></i> Peso:</strong> <span id="verPeso"></span> kg</div>
    <div class="col-md-4"><strong><i class="bi bi-rulers me-1"></i> Altura:</strong> <span id="verAltura"></span> cm</div>
    <div class="col-md-4"><strong><i class="bi bi-heart-pulse me-1"></i> Tensión:</strong> <span id="verTension"></span></div>
    <div class="col-md-4"><strong><i class="bi bi-activity me-1"></i> Pulso:</strong> <span id="verPulso"></span> bpm</div>
    <div class="col-md-4"><strong><i class="bi bi-thermometer me-1"></i> Temperatura:</strong> <span id="verTemp"></span> °C</div>
    <div class="col-md-4"><strong><i class="bi bi-droplet-half me-1"></i> PO2:</strong> <span id="verPo2"></span></div>
    <div class="col-md-4"><strong><i class="bi bi-calendar me-1"></i> Fecha:</strong> <span id="verFecha"></span></div>
    <div class="col-md-4"><strong><i class="bi bi-clock me-1"></i> Hora:</strong> <span id="verHora"></span></div>
    <div class="col-md-4"><strong><i class="bi bi-currency-dollar me-1"></i> Precio:</strong> <span id="verPrecio"></span> Fcfa</div>
  </div>

  <!-- Línea separadora -->
  <hr class="mt-4 border border-primary-subtle">
</div>


      <form id="formHistorial">
        <div class="modal-body p-4">
          <!-- Switch: Antecedentes Patológicos -->
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="switchAntecedentes">
            <label class="form-check-label" for="switchAntecedentes">¿Antecedentes patológicos?</label>
          </div>
          <div id="antecedentesFields" class="row g-3 mb-3 d-none">
            <div class="col-12 col-md-6">
              <label for="cualAntecedente" class="form-label">¿Cuál es?</label>
              <input type="text" class="form-control" id="cualAntecedente" name="cual_antecedente">
            </div>
            <div class="col-12 col-md-6">
              <label for="tratamientoAntecedente" class="form-label">Tratamiento</label>
              <input type="text" class="form-control" id="tratamientoAntecedente" name="tratamiento_antecedente">
            </div>
          </div>

          <!-- Switch: Alergia Medicamentosa -->
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="switchAlergia">
            <label class="form-check-label" for="switchAlergia">¿Alergia a medicamentos?</label>
          </div>
          <div id="alergiaFields" class="mb-3 d-none">
            <label for="medicamentoAlergia" class="form-label">¿A qué medicamento?</label>
            <input type="text" class="form-control" id="medicamentoAlergia" name="medicamento_alergia">
          </div>

          <!-- Switch: Visita médica reciente -->
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="switchVisita">
            <label class="form-check-label" for="switchVisita">¿Visita médica en los últimos 14 días?</label>
          </div>
          <div id="visitaFields" class="row g-3 mb-3 d-none">
            <div class="col-12 col-md-6">
              <label for="diagnosticoVisita" class="form-label">Diagnóstico</label>
              <input type="text" class="form-control" id="diagnosticoVisita" name="diagnostico_visita">
            </div>
            <div class="col-12 col-md-6">
              <label for="tratamientoVisita" class="form-label">Tratamiento</label>
              <input type="text" class="form-control" id="tratamientoVisita" name="tratamiento_visita">
            </div>
          </div>

          <!-- Grupo Sanguíneo -->
          <div class="mb-3">
            <label for="grupoSanguineo" class="form-label">Grupo Sanguíneo</label>
            <select class="form-select" id="grupoSanguineo" name="grupo_sanguineo">
              <option selected disabled>Seleccione un grupo</option>
              <option>A+</option>
              <option>A-</option>
              <option>B+</option>
              <option>B-</option>
              <option>AB+</option>
              <option>AB-</option>
              <option>O+</option>
              <option>O-</option>
            </select>
          </div>

          <!-- HEA -->
          <div class="mb-3">
            <label for="hea" class="form-label">HEA (Historia de la Enfermedad Actual)</label>
            <textarea class="form-control" id="hea" name="hea" rows="3" placeholder="Describa la enfermedad actual..."></textarea>
          </div>

          <!-- Observaciones -->
          <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones del médico</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Observaciones clínicas..."></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script>
  document.getElementById("switchAntecedentes").addEventListener("change", function () {
    document.getElementById("antecedentesFields").classList.toggle("d-none", !this.checked);
  });

  document.getElementById("switchAlergia").addEventListener("change", function () {
    document.getElementById("alergiaFields").classList.toggle("d-none", !this.checked);
  });

  document.getElementById("switchVisita").addEventListener("change", function () {
    document.getElementById("visitaFields").classList.toggle("d-none", !this.checked);
  });
</script>
