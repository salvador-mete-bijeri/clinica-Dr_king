<!-- End Navbar -->
<?php

require '../conexion/conexion.php';

$sqlPacientes = "SELECT `consultas`.*, `pacientes`.*
FROM `consultas` 
	LEFT JOIN `pacientes` ON `consultas`.`paciente_id` = `pacientes`.`id`;";

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
                 <th>NOMBRE</th>
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
    $(document).ready(function() {
      $('#example').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
          url: 'datos_consultas.php',
          type: 'GET'
        },
        columns: [{
          data: 'nombre'
           },
          {
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
            render: function(data) {
              return `
             

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
  const codigo = $(this).data('cod');  // <== agrega esto
  const fecha = $(this).data('fecha'); // <== y esto también

            // ahora también funciona
  $('#historialConsultaId').val(id);

  
  
  // Mostrar valores en el modal
  $('#verCod').text(codigo);
  $('#verPeso').text($(this).data('peso'));
  $('#verAltura').text($(this).data('altura'));
  $('#verTension').text($(this).data('tension'));
  $('#verPulso').text($(this).data('pulso'));
  $('#verTemp').text($(this).data('temp'));
  $('#verPo2').text($(this).data('po2'));
  $('#verFecha').text(fecha);
  $('#verHora').text($(this).data('hora'));
  $('#verPrecio').text($(this).data('precio'));

      // Consulta los datos clínicos adicionales
      $.ajax({
        url: 'ver_consulta.php',
        type: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
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
        error: function() {
          alert('Error al cargar detalle de consulta');
        }
      });
    });
  </script>






  <div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow-lg rounded-3">
        <div class="modal-header bg-primary text-white p-4 rounded-top-3">
          <h5 class="modal-title fs-5" id="historialModalLabel">
            <i class="bi bi-journal-medical me-2"></i> Formulario de Historial Médico
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body p-4">
          <div class="bg-light rounded p-4 mb-4 border border-2 border-primary-subtle shadow-sm">
            <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
              <i class="bi bi-person-badge me-2 fs-5"></i> Datos del Paciente / Consulta
            </h6>

            <div class="row g-3 text-secondary">
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Código Paciente</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-upc-scan me-2"></i><span id="verCod"></span></span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Peso</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-speedometer2 me-2"></i><span id="verPeso"></span> kg</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Altura</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-rulers me-2"></i><span id="verAltura"></span> cm</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Tensión</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-heart-pulse me-2"></i><span id="verTension"></span> mmHg</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Pulso</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-activity me-2"></i><span id="verPulso"></span> bpm</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Temperatura</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-thermometer-half me-2"></i><span id="verTemp"></span> °C</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">SpO2</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-lungs me-2"></i><span id="verPo2"></span> %</span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Fecha</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-calendar-event me-2"></i><span id="verFecha"></span></span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Hora</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-clock me-2"></i><span id="verHora"></span></span>
              </div>
              <div class="col-md-6 col-lg-4">
                <small class="d-block text-muted">Precio</small>
                <span class="d-block fw-bold text-dark"><i class="bi bi-currency-dollar me-2"></i><span id="verPrecio"></span> Fcfa</span>
              </div>
            </div>
          </div>




          <form action="../php/actualizar_historial.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="historialConsultaId" name="consulta_id">
            <input type="hidden" id="modalCodigo" name="codigo_pac">
<input type="hidden" id="modalFecha" name="fecha">




            <h6 class="text-secondary fw-bold mb-3 d-flex align-items-center">
              <i class="bi bi-clipboard-pulse me-2 fs-5"></i> Detalles del Historial
            </h6>



            <div class="card card-body bg-light-subtle mb-3">
              <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input flex-shrink-0" type="checkbox" id="switchAntecedentes">
                <label class="form-check-label ms-3 fw-semibold text-dark" for="switchAntecedentes">
                  <i class="bi bi-virus me-2 text-danger"></i> ¿Antecedentes patológicos?
                </label>
              </div>



              <div id="antecedentesFields" class="row g-3 mt-2 d-none p-3 border rounded">
                <div class="col-12 col-md-6">
                  <label for="cualAntecedente" class="form-label text-muted small">¿Cuál es?</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-question-lg"></i></span>
                    <input type="text" class="form-control" id="cualAntecedente" name="cual_antecedente" placeholder="Ej: Diabetes, Hipertensión">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <label for="tratamientoAntecedente" class="form-label text-muted small">Tratamiento</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-bandages"></i></span>
                    <input type="text" class="form-control" id="tratamientoAntecedente" name="tratamiento_antecedente" placeholder="Ej: Insulina, Diuréticos">
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-body bg-light-subtle mb-3">
              <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input flex-shrink-0" type="checkbox" id="switchAlergia">
                <label class="form-check-label ms-3 fw-semibold text-dark" for="switchAlergia">
                  <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i> ¿Alergia a medicamentos?
                </label>
              </div>
              <div id="alergiaFields" class="mt-2 d-none p-3 border rounded">
                <label for="medicamentoAlergia" class="form-label text-muted small">¿A qué medicamento?</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-pill"></i></span>
                  <input type="text" class="form-control" id="medicamentoAlergia" name="medicamento_alergia" placeholder="Ej: Penicilina, Ibuprofeno">
                </div>
              </div>
            </div>

            <div class="card card-body bg-light-subtle mb-3">
              <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input flex-shrink-0" type="checkbox" id="switchVisita">
                <label class="form-check-label ms-3 fw-semibold text-dark" for="switchVisita">
                  <i class="bi bi-hospital-fill me-2 text-info"></i> ¿Visita médica en los últimos 14 días?
                </label>
              </div>
              <div id="visitaFields" class="row g-3 mt-2 d-none p-3 border rounded">
                <div class="col-12 col-md-6">
                  <label for="diagnosticoVisita" class="form-label text-muted small">Diagnóstico</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-clipboard2-pulse"></i></span>
                    <input type="text" class="form-control" id="diagnosticoVisita" name="diagnostico_visita" placeholder="Ej: Gripe, infección">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <label for="tratamientoVisita" class="form-label text-muted small">Tratamiento</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-capsule"></i></span>
                    <input type="text" class="form-control" id="tratamientoVisita" name="tratamiento_visita" placeholder="Ej: Antibióticos, reposo">
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="grupoSanguineo" class="form-label fw-semibold text-dark d-flex align-items-center">
                <i class="bi bi-droplet me-2 fs-5 text-primary"></i> Grupo Sanguíneo
              </label>
              <select class="form-select" id="grupoSanguineo" name="grupo_sanguineo" required>
                <option value="" selected disabled>Seleccione un grupo</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="hea" class="form-label fw-semibold text-dark d-flex align-items-center">
                <i class="bi bi-file-earmark-medical me-2 fs-5 text-primary"></i> HEA (Historia de la Enfermedad Actual)
              </label>
              <textarea class="form-control" id="hea" name="hea" rows="3" placeholder="Describa la historia de la enfermedad actual del paciente..." style="resize: none;" required></textarea>
            </div>

            <div class="mb-3">
              <label for="observaciones" class="form-label fw-semibold text-dark d-flex align-items-center">
                <i class="bi bi-chat-dots me-2 fs-5 text-primary"></i> Observaciones del médico
              </label>
              <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Añade cualquier observación clínica relevante..." style="resize: none;" required></textarea>
            </div>

            <div class="modal-footer bg-light p-3 rounded-bottom-3">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-circle me-1"></i> Cancelar
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Guardar Historial
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>







  <script>
    document.getElementById("switchAntecedentes").addEventListener("change", function() {
      document.getElementById("antecedentesFields").classList.toggle("d-none", !this.checked);
    });

    document.getElementById("switchAlergia").addEventListener("change", function() {
      document.getElementById("alergiaFields").classList.toggle("d-none", !this.checked);
    });

    document.getElementById("switchVisita").addEventListener("change", function() {
      document.getElementById("visitaFields").classList.toggle("d-none", !this.checked);
    });
  </script>