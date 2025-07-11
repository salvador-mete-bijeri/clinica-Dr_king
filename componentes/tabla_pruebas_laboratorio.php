<!-- End Navbar -->
<?php

require '../conexion/conexion.php';

$sqlPacientes = "SELECT 
    pacientes.codigo,
    pacientes.nombre,
    GROUP_CONCAT(tipo_prueba.nombre_prueba SEPARATOR ', ') AS pruebas,
    prueba.fecha,
    MAX(prueba.estado) AS estado,
    MAX(prueba.id_prueba) AS id_prueba,
    MAX(tipo_prueba.id) AS tipo_prueba_id
FROM prueba
LEFT JOIN pacientes ON prueba.paciente = pacientes.id
LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
WHERE prueba.pagado = 1
GROUP BY pacientes.codigo, prueba.fecha
ORDER BY prueba.fecha DESC";

$pacientes = $conn->query($sqlPacientes);



// iniciando la sesion

// session_start();
// if(!isset($_SESSION['usuario'])){

//   header('Location:../login.php');
// }


?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>TABLA DE LABORATORIO</h6>

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
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>PRUEBA</th>
                                <th>TESULTADO</th>
                                <th>FECHA</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php while ($row_pacientes = $pacientes->fetch_assoc()) { ?>



                                    <?php
                                    $codigo = $row_pacientes['codigo'];
                                    $fecha = $row_pacientes['fecha'];

                                    $check = $conn->prepare("SELECT COUNT(*) AS pendientes 
                         FROM prueba 
                         JOIN pacientes ON prueba.paciente = pacientes.id 
                         WHERE pacientes.codigo = ? AND prueba.fecha = ? AND (prueba.resultado IS NULL OR prueba.resultado = '')");
                                    $check->bind_param("ss", $codigo, $fecha);
                                    $check->execute();
                                    $check_result = $check->get_result()->fetch_assoc();
                                    $hayPendientes = $check_result['pendientes'] > 0;
                                    ?>





                                    <tr>
                                        <td><?= $row_pacientes['id_prueba']; ?></td>
                                        <td><?= $row_pacientes['codigo']; ?></td>
                                        <td><?= $row_pacientes['nombre']; ?></td>
                                        <td><?= $row_pacientes['pruebas']; ?></td> <!-- pruebas concatenadas -->
                                        <td>
                                            <?= $row_pacientes['estado'] == 0
                                                ? "<span class='badge bg-danger'>PENDIENTE...</span>"
                                                : "<span class='badge bg-success'>RESULTADOS...</span>"; ?>
                                        </td>
                                        <td><?= $row_pacientes['fecha']; ?></td>
                                        <td>
                                            <?php if ($hayPendientes): ?>
                                                <a href="#" class="btn btn-sm btn-warning editar-resultados"
                                                    data-codigo="<?= $codigo ?>" data-fecha="<?= $fecha ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>PRUEBA</th>
                                    <th>TESULTADO</th>
                                    <th>FECHA</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#example').DataTable();
    </script>






<!-- Modal: Introducir Resultados -->
<div class="modal fade" id="modalEditarResultados" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <!-- Header -->
      <div class="modal-header bg-gradient-primary text-white rounded-top-4">
        <h5 class="modal-title">
          <i class="bi bi-journal-medical me-2"></i> Introducir Resultados de Pruebas Pendientes
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Formulario -->
      <form id="formEditarResultados">
        <div class="modal-body py-4 px-4">
          <div id="contenidoResultados" class="row g-4">
            <!-- Aquí se inyectarán las tarjetas de pruebas -->
            <div class="text-muted text-center">Cargando pruebas pendientes...</div>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer bg-light rounded-bottom-4">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar Resultados
          </button>
        </div>
      </form>
    </div>
  </div>
</div>





    <script>
document.addEventListener("DOMContentLoaded", function () {
  const modal = new bootstrap.Modal(document.getElementById('modalEditarResultados'));
  const form = document.getElementById("formEditarResultados");
  const contenidoResultados = document.getElementById("contenidoResultados");

  // Cargar pruebas al hacer clic
  document.querySelectorAll(".editar-resultados").forEach(btn => {
    btn.addEventListener("click", function () {
      const codigo = this.dataset.codigo;
      const fecha = this.dataset.fecha;

      fetch("ajax_cargar_pruebas.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `codigo=${codigo}&fecha=${fecha}`
      })
      .then(res => res.text())
      .then(html => {
        contenidoResultados.innerHTML = html;
        form.dataset.codigo = codigo;
        form.dataset.fecha = fecha;
        modal.show();
      });
    });
  });

  // Envío del formulario
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("../php/ajax_guardar_pruebas.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(response => {
      if (response.success) {
        // Mostrar alerta en el modal
        contenidoResultados.innerHTML = `
          <div class="alert alert-success text-center rounded-3" role="alert">
            <i class="bi bi-check2-circle me-2"></i>
            <strong>Resultados guardados correctamente.</strong>
          </div>
        `;

        // Esperar 2 segundos y cerrar el modal
        setTimeout(() => {
          modal.hide();
          location.reload(); // Opcional: para actualizar el estado de la tabla
        }, 2000);
      } else {
        contenidoResultados.innerHTML = `
          <div class="alert alert-danger text-center rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Hubo un error al guardar los resultados.</strong>
          </div>
        `;
      }
    });
  });
});
</script>

<script>

$(document).ready(function() {
  const tabla = $('#example').DataTable({
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      paginate: {
        previous: "Anterior",
        next: "Siguiente"
      },
      zeroRecords: "No hay resultados para mostrar"
    },
    // Inicialmente vacía la búsqueda para que no muestre registros
    search: {
      search: ''
    },
    // No mostrar datos al inicio
    deferRender: true,
    initComplete: function () {
      // Vaciar la tabla al cargar para ocultar registros
      this.api().search('').draw();
      this.api().rows().every(function () {
        this.nodes().to$().hide();
      });
    }
  });

  // Cuando se escribe en el buscador, mostrar filas que coincidan
  $('#example_filter input').on('keyup change', function () {
    const val = this.value;
    if(val.length > 0) {
      tabla.rows().every(function () {
        this.nodes().to$().show();
      });
      tabla.search(val).draw();
    } else {
      tabla.rows().every(function () {
        this.nodes().to$().hide();
      });
      tabla.search('').draw();
    }
  });
});


</script>
