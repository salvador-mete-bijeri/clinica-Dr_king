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
                             <tbody>
                                 <?php while ($row_pacientes = $pacientes->fetch_assoc()) {  ?>

                                     <tr>
                                         <td> <?= $row_pacientes['paciente_cod']; ?></td>
                                         <td> <?= $row_pacientes['peso']; ?></td>
                                         <td> <?= $row_pacientes['altura']; ?></td>
                                         <td> <?= $row_pacientes['tension_arterial']; ?></td>
                                         <td> <?= $row_pacientes['pulso']; ?></td>
                                         <td> <?= $row_pacientes['temperatura']; ?></td>

                                         <td> <?= $row_pacientes['PO2']; ?></td>
                                         <td> <?= $row_pacientes['fecha']; ?></td>
                                         <td> <?= $row_pacientes['hora']; ?></td>
                                         <td> <?= $row_pacientes['precio']; ?></td>

                                         <td>
                                             <a href="../ENFERMERA/editar_consultas.php?id=<?= $row_pacientes['id']; ?>&paciente_id=<?= $row_pacientes['paciente_id']; ?>" class="btn btn-sm btn-primary">
                                                 <i class="fas fa-edit me-1"></i> Editar
                                             </a>

                                             <button type="button" class="btn btn-sm btn-info ms-2" data-bs-toggle="modal" data-bs-target="#consultaDetallesModal"
                                                 data-id="<?= $row_pacientes['id']; ?>" data-paciente_id="<?= $row_pacientes['paciente_id']; ?>">
                                                 <i class="fas fa-eye me-1"></i> Ver Detalles
                                             </button>
                                         </td>
                                     </tr>


                                 <?php } ?>
                             </tbody>
                             <tfoot>
                                 <tr>
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
                                 </tr>
                             </tfoot>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

<div class="modal fade" id="consultaDetallesModal" tabindex="-1" aria-labelledby="consultaDetallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title" id="consultaDetallesModalLabel"><i class="fas fa-info-circle me-2"></i> Detalles de la Consulta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="modal-content-placeholder">
                    <p class="text-center text-muted"><i class="fas fa-spinner fa-spin me-2"></i> Cargando detalles...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<script>
    // Usamos jQuery para simplificar la manipulación del DOM y las peticiones AJAX
    $(document).ready(function() {
        var consultaDetallesModal = document.getElementById('consultaDetallesModal');
        consultaDetallesModal.addEventListener('show.bs.modal', function (event) {
            // Botón que disparó el modal
            var button = event.relatedTarget;

            // Extraer información de los atributos data-*
            var consultaId = button.getAttribute('data-id');
            var pacienteId = button.getAttribute('data-paciente_id');

            // Actualizar el contenido del modal (mostrar spinner o mensaje de carga)
            var modalBodyPlaceholder = document.getElementById('modal-content-placeholder');
            modalBodyPlaceholder.innerHTML = '<p class="text-center text-muted"><i class="fas fa-spinner fa-spin me-2"></i> Cargando detalles...</p>';

            // Realizar una petición AJAX para obtener los detalles de la consulta
            $.ajax({
                url: 'obtener_detalles_consulta.php', // El script PHP que crearemos
                type: 'GET',
                data: {
                    id_consulta: consultaId,
                    paciente_id: pacienteId
                },
                dataType: 'json', // Esperamos una respuesta JSON
                success: function(data) {
                    if (data && data.success) {
                        var consulta = data.consulta;
                        var paciente = data.paciente;

                        // Construir el HTML para mostrar los detalles
                        var htmlContent = `
                            <h4 class="text-primary mb-3"><i class="fas fa-user-circle me-2"></i> Datos del Paciente</h4>
                            <div class="row mb-4">
                                <div class="col-md-6 detail-item"><i class="fas fa-id-badge"></i> <strong>Código:</strong> ${paciente.codigo}</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-user"></i> <strong>Nombre:</strong> ${paciente.nombre} ${paciente.apellidos}</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-calendar-alt"></i> <strong>F. Nacimiento:</strong> ${paciente.fecha_nacimiento}</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-id-card"></i> <strong>DIP:</strong> ${paciente.dip}</div>
                            </div>

                            <hr>

                            <h4 class="text-success mb-3"><i class="fas fa-stethoscope me-2"></i> Exploración Médica</h4>
                            <div class="row mb-4">
                                <div class="col-md-6 detail-item"><i class="fas fa-weight-hanging"></i> <strong>Peso:</strong> ${consulta.peso} kg</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-ruler-vertical"></i> <strong>Altura:</strong> ${consulta.altura} cm</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-heartbeat"></i> <strong>Tensión Arterial:</strong> ${consulta.tension_arterial} mmHg</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-pulse"></i> <strong>Pulso:</strong> ${consulta.pulso} bpm</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-thermometer-half"></i> <strong>Temperatura:</strong> ${consulta.temperatura} °C</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-lungs"></i> <strong>SpO2:</strong> ${consulta.PO2} %</div>
                            </div>

                            <hr>

                            <h4 class="text-warning mb-3"><i class="fas fa-file-medical-alt me-2"></i> Otros Datos de Consulta</h4>
                            <div class="row mb-4">
                                <div class="col-md-6 detail-item"><i class="fas fa-calendar-check"></i> <strong>Fecha:</strong> ${consulta.fecha}</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-clock"></i> <strong>Hora:</strong> ${consulta.hora}</div>
                                <div class="col-md-6 detail-item"><i class="fas fa-dollar-sign"></i> <strong>Precio:</strong> ${consulta.precio}</div>
                                <div class="col-12 detail-item"><i class="fas fa-notes-medical"></i> <strong>Motivo de Consulta:</strong> ${consulta.motivo}</div>
                            </div>
                        `;
                        modalBodyPlaceholder.innerHTML = htmlContent;
                    } else {
                        modalBodyPlaceholder.innerHTML = '<p class="text-center text-danger"><i class="fas fa-exclamation-triangle me-2"></i> No se pudieron cargar los detalles de la consulta.</p>';
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", status, error);
                    modalBodyPlaceholder.innerHTML = '<p class="text-center text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Hubo un error al conectar con el servidor.</p>';
                }
            });
        });
    });
</script>


     <script>
         $('#example').DataTable();
     </script>