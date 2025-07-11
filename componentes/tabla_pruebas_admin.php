<!-- End Navbar -->
<?php


require '../conexion/conexion.php';

$sqlPacientes = "SELECT 
    pacientes.nombre,
    pacientes.codigo,
    prueba.fecha,
    GROUP_CONCAT(tipo_prueba.nombre_prueba SEPARATOR '<br>') AS pruebas,
    GROUP_CONCAT(tipo_prueba.precio SEPARATOR '<br>') AS precios,
    MAX(prueba.id_prueba) AS id_prueba,
    MAX(prueba.estado) AS estado,

    

    -- Estado: 1 solo si todas las pruebas tienen estado = 1
    CASE 
        WHEN SUM(prueba.estado) = COUNT(*) THEN 1
        ELSE 0
    END AS estado,
   

    -- Verifica si todas las pruebas están pagadas
    CASE 
        WHEN SUM(prueba.pagado) = COUNT(*) THEN 1
        ELSE 0
    END AS pagado

FROM prueba
LEFT JOIN pacientes ON prueba.paciente = pacientes.id
LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
LEFT JOIN consultas ON consultas.paciente_id = pacientes.id

GROUP BY pacientes.codigo, prueba.fecha
ORDER BY prueba.fecha DESC;
;

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

                    <div class="row">

                        <div class="col-md-6">
                            <h6> tabla de Pruebas de Laboratorios</h6>
                        </div>

                        <div class="col-md-6 align-items-md-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalPagar">
                                PAGAR
                            </button>
                        </div>
                    </div>







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
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'pagado') {
                    ?>

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Hola!</strong> Se realizo el pago con exito.
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
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
                    ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Error al guardar! </strong> No se guardaron las pruebas.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'pendientes') {
                    ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong> Gracias! </strong> No hay pruebas pendientes.
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
                                <th>PRECIO</th>
                                <th>PAGADO</th>
                                <th>RESULTADO</th>
                                <th>FECHA</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php while ($row_pacientes = $pacientes->fetch_assoc()) { ?>
                                    <tr>
                                        <?php
                                        $estado_html = ($row_pacientes['estado'] == 0)
                                            ? "<span class='badge bg-danger'>PENDIENTE...</span>"
                                            : "<span class='badge bg-success'>RESULTADOS...</span>";

                                        $pagado_html = ($row_pacientes['pagado'] == 0)
                                            ? "<span class='badge bg-danger'>PENDIENTE...</span>"
                                            : "<span class='badge bg-success'>PAGADA...</span>";
                                        ?>

                                        <td><?= $row_pacientes['id_prueba']; ?></td>
                                        <td><?= $row_pacientes['codigo']; ?></td>
                                        <td><?= $row_pacientes['nombre']; ?></td>
                                        <td><?= $row_pacientes['pruebas']; ?></td> <!-- Pruebas agrupadas -->
                                        <td><?= $row_pacientes['precios']; ?></td> <!-- Precios agrupados -->
                                        <td><?= $pagado_html; ?></td>
                                        <td><?= $estado_html; ?></td>
                                        <td><?= $row_pacientes['fecha']; ?></td>

                                        <td>
                                            <?php if ($row_pacientes['pagado'] == 0): ?>
                                                <button class="btn btn-sm btn-success pagarBtn"
                                                    data-codigo="<?= $row_pacientes['codigo']; ?>"
                                                    data-fecha="<?= $row_pacientes['fecha']; ?>">
                                                    PAGAR
                                                </button>

                                            <?php endif; ?>

                                            <a href="../reportes/pruebas_laboratorio_por_dia.php?codigo=<?= $row_pacientes['codigo']; ?>&fecha=<?= $row_pacientes['fecha']; ?>"
                                                class="btn btn-sm btn-warning" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>


                            <tfoot>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>PRUEBA</th>
                                <th>PRECIO</th>
                                <th>PAGADO</th>
                                <th>RESULTADO</th>
                                <th>FECHA</th>
                                <th>Acciones</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmarPagoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold" id="modalLabel">Confirmar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que quieres pagar esta prueba?</p>
                    <ul>
                        <li><strong>ID Prueba:</strong> <span id="modal-id_prueba"></span></li>
                        <li><strong>Tipo de Prueba:</strong> <span id="modal-id_tipo_prueba"></span></li>
                        <li><strong>Código:</strong> <span id="modal-codigo"></span></li>
                        <li><strong>Precio:</strong> <span id="modal-precio"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success" id="confirmarPagoBtn">Sí, pagar</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalPagar" tabindex="-1" aria-labelledby="modalPagarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarLabel">💳 Registrar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <form id="formPago" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código del Paciente</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha del Pago</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>

                <!-- Contenedor donde se mostrará el resultado -->
                <div id="resultadoPago" class="mt-4"></div>

            </div>
        </div>
    </div>




    <!-- Modal de Pago -->
    <div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="formPago" method="post" action="../php/procesar_pago_seleccionado.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPagoLabel">💳 Selecciona las pruebas a pagar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="codigo" id="codigoInput">
                        <input type="hidden" name="fecha" id="fechaInput">


                        <div id="listaPruebas"></div>

                        <hr>
                        <h5>Total: <span id="totalFactura"> FCFA</span></h5>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script>
        $('#example').DataTable();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var confirmarPagoModal = document.getElementById('confirmarPagoModal');

            confirmarPagoModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id_prueba = button.getAttribute('data-id_prueba');
                var id_tipo_prueba = button.getAttribute('data-id_tipo_prueba');
                var codigo = button.getAttribute('data-codigo');
                var precio = button.getAttribute('data-precio');

                // Mostrar los datos en el modal
                document.getElementById('modal-id_prueba').textContent = id_prueba;
                document.getElementById('modal-id_tipo_prueba').textContent = id_tipo_prueba;
                document.getElementById('modal-codigo').textContent = codigo;
                document.getElementById('modal-precio').textContent = precio;

                // Actualizar el enlace de confirmación
                var confirmarBtn = document.getElementById('confirmarPagoBtn');
                confirmarBtn.href = `../php/guardar_pagos.php?id_prueba=${id_prueba}&id_tipo_prueba=${id_tipo_prueba}&codigo=${codigo}&precio=${precio}`;
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#formPago').submit(function (e) {
                e.preventDefault(); // evita que el formulario recargue la página

                var datos = $(this).serialize(); // serializa los datos del formulario

                $.ajax({
                    type: 'POST',
                    url: 'verificar_pagos.php',
                    data: datos,
                    success: function (response) {
                        $('#resultadoPago').html(response); // muestra el resultado en el contenedor
                    },
                    error: function () {
                        $('#resultadoPago').html('<div class="alert alert-danger">Hubo un error al procesar el pago.</div>');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('.pagarBtn').on('click', function () {
                const codigo = $(this).data('codigo');
                const fecha = $(this).data('fecha');


                $('#codigoInput').val(codigo);
                $('#fechaInput').val(fecha);

                $('#listaPruebas').html('Cargando pruebas...');

                $.ajax({
                    url: 'cargar_pruebas.php',
                    method: 'POST',
                    data: { codigo, fecha },
                    success: function (response) {
                        $('#listaPruebas').html(response);
                        calcularTotal();
                        $('#modalPago').modal('show');
                    }
                });
            });

            // Actualiza el total al seleccionar/deseleccionar
            $(document).on('change', '.prueba-checkbox', function () {
                calcularTotal();
            });

            function calcularTotal() {
                let total = 0;
                $('.prueba-checkbox:checked').each(function () {
                    total += parseFloat($(this).data('precio'));
                });
                $('#totalFactura').text(total.toFixed(2) + ' FCFA');
            }
        });
    </script>