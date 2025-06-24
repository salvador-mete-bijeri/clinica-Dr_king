 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';

    $sqlPacientes = "SELECT * FROM citas";

    $pacientes = $conn->query($sqlPacientes);



    // iniciando la sesion



    ?>
 <div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card mb-4">
                 <div class="card-header">

                     <a href="../DOCTOR/registrar_citas.php" class="btn btn-primary btn-sm">Añadir</a>



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
                                 <tr>
                                     <th>ID</th>
                                     <th>CODIGO</th>
                                     <th>NOMBRE</th>
                                     <th>FECHA</th>
                                     <th>Acciones</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php while ($row_pacientes = $pacientes->fetch_assoc()) {  ?>

                                     <tr>
                                         <td> <?= $row_pacientes['id']; ?></td>
                                         <td> <?= $row_pacientes['codigo']; ?></td>

                                         <?php

                                            $paciente = $row_pacientes['paciente'];

                                            $sqlCitas = "SELECT * FROM pacientes where id=$paciente";

                                            $resultado_citas = $conn->query($sqlCitas);
                                            $fila_citas=mysqli_fetch_assoc($resultado_citas);

                                            ?>
                                                   <td> <?= $fila_citas['nombre'] . '' .$fila_citas['apellidos']; ?></td>

                                         <td> <?= $row_pacientes['fecha']; ?></td>

                                         <td>

                                             <a href="../DOCTOR/editar_cita.php?id=<?= $row_pacientes['id'];  ?>" class="btn btn-sm btn-primary">EDITAR</a>

                                         </td>
                                     </tr>


                                 <?php } ?>
                             </tbody>
                             <tfoot>
                             <tr>
                                     <th>ID</th>
                                     <th>CODIGO</th>
                                     <th>NOMBRE</th>
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