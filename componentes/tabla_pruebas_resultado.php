 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';

    $sqlPacientes = "SELECT `prueba`.*, `pacientes`.`nombre`, `pacientes`.`codigo`, `consultas`.`id`, `tipo_prueba`.`nombre_prueba`, `tipo_prueba`.`id` FROM `prueba` LEFT JOIN `pacientes` ON `prueba`.`paciente` = `pacientes`.`id` LEFT JOIN `consultas` ON `consultas`.`paciente_id` = `pacientes`.`id` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id` WHERE estado=1 and pagado=1";

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
                     <h6>Authors table</h6>

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
                                 <?php while ($row_pacientes = $pacientes->fetch_assoc()) {  ?>

                                     <tr>

                                         <?php

                                         $mira=$row_pacientes['estado'];

                                            if ($mira == 0) {

                                                $mira = "<span class='badge bg-danger'>PENDIENTE...</span>";
                                            } else {
                                                $mira = "<span class='badge bg-success'>RESULTADOS...</span>";
                                            }


                                            ?>


                                         <td> <?= $row_pacientes['id_prueba']; ?></td>
                                         <td> <?= $row_pacientes['codigo']; ?></td>
                                         <td> <?= $row_pacientes['nombre']; ?></td>
                                         <td> <?= $row_pacientes['nombre_prueba']; ?></td>
                                         <td > <?= $mira; ?></td>
                                         <td> <?= $row_pacientes['fecha']; ?></td>

                                         <td>

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