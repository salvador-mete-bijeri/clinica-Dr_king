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




<div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="modalConsultaLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-white border-bottom">
        <h5 class="modal-title fw-bold text-primary" id="modalConsultaLabel">
          <i class="bi bi-file-earmark-medical me-2"></i>Resumen de la Consulta Médica
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body bg-light">
        <!-- DATOS CONSULTA -->
        <div class="card mb-4 border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title text-secondary mb-3">
              <i class="bi bi-person-circle me-2"></i>Datos del Paciente / Consulta
            </h6>
            <div class="row g-3">
              <div class="col-md-4"><strong><i class="bi bi-upc-scan me-1"></i>Código:</strong> <span id="verCod"></span></div>
              <div class="col-md-4"><strong><i class="bi bi-speedometer2 me-1"></i>Peso:</strong> <span id="verPeso"></span> kg</div>
              <div class="col-md-4"><strong><i class="bi bi-rulers me-1"></i>Altura:</strong> <span id="verAltura"></span> cm</div>
              <div class="col-md-4"><strong><i class="bi bi-heart-pulse me-1"></i>Tensión:</strong> <span id="verTension"></span></div>
              <div class="col-md-4"><strong><i class="bi bi-activity me-1"></i>Pulso:</strong> <span id="verPulso"></span> bpm</div>
              <div class="col-md-4"><strong><i class="bi bi-thermometer me-1"></i>Temperatura:</strong> <span id="verTemp"></span> °C</div>
              <div class="col-md-4"><strong><i class="bi bi-droplet-half me-1"></i>PO2:</strong> <span id="verPo2"></span></div>
              <div class="col-md-4"><strong><i class="bi bi-calendar me-1"></i>Fecha:</strong> <span id="verFecha"></span></div>
              <div class="col-md-4"><strong><i class="bi bi-clock me-1"></i>Hora:</strong> <span id="verHora"></span></div>
              <div class="col-md-4"><strong><i class="bi bi-currency-dollar me-1"></i>Precio:</strong> <span id="verPrecio"></span> Fcfa</div>
            </div>
          </div>
        </div>

        <!-- DATOS DETALLE -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title text-success mb-3">
              <i class="bi bi-clipboard2-pulse me-2"></i>Información Clínica
            </h6>
            <div class="row g-3">
              <div class="col-md-6"><strong><i class="bi bi-journal-medical me-1"></i>Antecedentes Patológicos:</strong> <span id="verPatologicos"></span></div>
              <div class="col-md-6"><strong><i class="bi bi-droplet-fill me-1"></i>Grupo Sanguíneo:</strong> <span id="verSangre"></span></div>
              <div class="col-md-6"><strong><i class="bi bi-capsule me-1"></i>Alergia a Medicamentos:</strong> <span id="verAlergia"></span></div>
              <div class="col-md-6"><strong><i class="bi bi-calendar-check me-1"></i>Visita Médica:</strong> <span id="verVisita"></span></div>
              <div class="col-md-12"><strong><i class="bi bi-hospital me-1"></i>Diagnóstico:</strong><br><span id="verDiagnostico" class="text-muted"></span></div>
              <div class="col-md-12"><strong><i class="bi bi-capsule-pill me-1"></i>Tratamiento:</strong><br><span id="verTratamiento" class="text-muted"></span></div>
              <div class="col-md-12"><strong><i class="bi bi-info-circle me-1"></i>Antecedente adicional:</strong><br><span id="verAntecedente" class="text-muted"></span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer bg-white">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle me-1"></i> Cerrar
        </button>
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