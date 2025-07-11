<!-- End Navbar -->
<?php

require '../conexion/conexion.php';


$sqlPacientes = "SELECT 
    pacientes.nombre,
    pacientes.codigo,
    prueba.fecha,

    -- Combina nombre de prueba con su resultado en una sola cadena
    GROUP_CONCAT(DISTINCT CONCAT(tipo_prueba.nombre_prueba, ': ', prueba.resultado) 
                 ORDER BY tipo_prueba.nombre_prueba SEPARATOR ';') AS pruebas_resultado,

    GROUP_CONCAT(DISTINCT tipo_prueba.precio 
                 ORDER BY tipo_prueba.nombre_prueba SEPARATOR '<br>') AS precios,

    MAX(prueba.id_prueba) AS id_prueba,

    CASE 
        WHEN SUM(CASE WHEN prueba.estado = 1 THEN 1 ELSE 0 END) = COUNT(*) THEN 1
        ELSE 0
    END AS estado,

    CASE 
        WHEN SUM(CASE WHEN prueba.pagado = 1 THEN 1 ELSE 0 END) = COUNT(*) THEN 1
        ELSE 0
    END AS pagado

FROM prueba
LEFT JOIN pacientes ON prueba.paciente = pacientes.id
LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id

GROUP BY pacientes.codigo, prueba.fecha, pacientes.nombre
ORDER BY prueba.fecha DESC;
";

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

                    <form action="../reportes/pruebas_laboratorio.php" method="post" target="_blank">
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

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'codigo') {
                    ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> no existe ningun registreo con esta fecha y este codigo.
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
                                <?php while ($row_pacientes = $pacientes->fetch_assoc()) {
                                    $estado_html = ($row_pacientes['estado'] == 0)
                                        ? "<span class='badge bg-danger'>PENDIENTE...</span>"
                                        : "<span class='badge bg-success'>RESULTADOS...</span>";

                                    $pagado_html = ($row_pacientes['pagado'] == 0)
                                        ? "<span class='badge bg-danger'>PENDIENTE...</span>"
                                        : "<span class='badge bg-success'>PAGADA...</span>";
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row_pacientes['id_prueba']); ?></td>
                                        <td><?= htmlspecialchars($row_pacientes['codigo']); ?></td>
                                        <td><?= htmlspecialchars($row_pacientes['nombre']); ?></td>
                                        <td style="white-space: normal;"><?= $row_pacientes['pruebas_resultado']; ?></td>
                                        <td><?= $estado_html; ?></td>
                                        <td><?= htmlspecialchars($row_pacientes['fecha']); ?></td>
                                        <td>
                                            <a href="../reportes/pruebas_laboratorio_por_dia.php?codigo=<?= urlencode($row_pacientes['codigo']); ?>&fecha=<?= urlencode($row_pacientes['fecha']); ?>"
                                                class="btn btn-sm btn-warning" target="_blank" title="Imprimir reporte">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <button class="btn btn-sm btn-primary ver-datos"
                                                data-id="<?= $row_pacientes['id_prueba']; ?>"
                                                data-codigo="<?= htmlspecialchars($row_pacientes['codigo']); ?>"
                                                data-nombre="<?= htmlspecialchars($row_pacientes['nombre']); ?>"
                                                data-pruebas="<?= htmlspecialchars($row_pacientes['pruebas_resultado']); ?>"
                                                data-estado="<?= strip_tags($estado_html); ?>"
                                                data-fecha="<?= htmlspecialchars($row_pacientes['fecha']); ?>"
                                                title="Ver detalles" data-bs-toggle="modal" data-bs-target="#modalDatos">
                                                <i class="fa fa-eye"></i>
                                            </button>


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



    <div class="modal fade" id="modalDatos" tabindex="-1" aria-labelledby="modalDatosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDatosLabel">Detalles de la prueba</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID Prueba:</strong> <span id="modal-id"></span></p>
                    <p><strong>Código:</strong> <span id="modal-codigo"></span></p>
                    <p><strong>Nombre:</strong> <span id="modal-nombre"></span></p>
                    <p><strong>Pruebas y resultados:</strong></p>
                    <ul id="modal-pruebas-lista" class="list-group mb-2"></ul>


                    <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
                    <p><strong>Fecha:</strong> <span id="modal-fecha"></span></p>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botonesVer = document.querySelectorAll('.ver-datos');

            botonesVer.forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('modal-id').textContent = this.dataset.id;
                    document.getElementById('modal-codigo').textContent = this.dataset.codigo;
                    document.getElementById('modal-nombre').textContent = this.dataset.nombre;
                    document.getElementById('modal-estado').textContent = this.dataset.estado;
                    document.getElementById('modal-fecha').textContent = this.dataset.fecha;

                    // Procesar pruebas con resultados
                    const listaPruebas = document.getElementById('modal-pruebas-lista');
                    listaPruebas.innerHTML = '';
                    const pruebas = this.dataset.pruebas.split(';'); // separado por ;

                    pruebas.forEach(item => {
                        if (item.trim() !== '') {
                            const [nombre, resultado] = item.split(':');
                            const li = document.createElement('li');
                            li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                            li.innerHTML = `
                        <span>${nombre.trim()}</span>
                        <span class="fw-bold">${resultado ? resultado.trim() : ''}</span>
                    `;
                            listaPruebas.appendChild(li);
                        }
                    });
                });
            });
        });
    </script>





    <script>


        $(document).ready(function () {
            $('#example').DataTable({
                // Opciones extras (opcional)
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    }
                }
            });
        });

    </script>