 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';

    $sqlPacientes = "SELECT * FROM personal";

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

                     <a href="../ADMINISTRADOR/registrar_personal.php" class="btn btn-primary btn-sm">Añadir</a>
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
                                 <th>DIP</th>
                                 <th>NOMBRE</th>
                                 <th>APELLIDOS</th>
                                 <th>FECHA-NACIMIENTO</th>
                                 <th>GENERO</th>
                                 <th>DIRECCION</th>
                                 <th>EMAIL</th>
                                 <th>TELEFONO</th>
                                 <th>NACIONALIDAD</th>
                                 <th>FECHA-REGISTRO</th>
                                 <th>Acciones</th>
                             </thead>
                             <tbody>
                                 <?php while ($row_pacientes = $pacientes->fetch_assoc()) {  ?>

                                     <tr>
                                         <td> <?= $row_pacientes['dip_personal']; ?></td>
                                         <td> <?= $row_pacientes['nombre']; ?></td>
                                         <td> <?= $row_pacientes['apellidos']; ?></td>
                                         <td> <?= $row_pacientes['fecha_nacimiento']; ?></td>
                                         <td> <?= $row_pacientes['sexo']; ?></td>

                                         <td> <?= $row_pacientes['direccion']; ?></td>
                                         <td> <?= $row_pacientes['email']; ?></td>
                                         <td> <?= $row_pacientes['telefono']; ?></td>
                                         <td> <?= $row_pacientes['nacionalidad']; ?></td>
                                         <td> <?= $row_pacientes['fecha_registro']; ?></td>
                                         <td>

                                             <a href="../ADMINISTRADOR/editar_personal.php?id_personal=<?= $row_pacientes['dip_personal'];  ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>




                                         </td>
                                     </tr>


                                 <?php } ?>
                             </tbody>
                             <tfoot>
                                 <th>DIP</th>
                                 <th>NOMBRE</th>
                                 <th>APELLIDOS</th>
                                 <th>FECHA-NACIMIENTO</th>
                                 <th>GENERO</th>
                                 <th>DIRECCION</th>
                                 <th>EMAIL</th>
                                 <th>TELEFONO</th>
                                 <th>NACIONALIDAD</th>
                                 <th>FECHA-REGISTRO</th>
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