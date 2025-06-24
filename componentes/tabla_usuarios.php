 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';

    $sqlPacientes = "SELECT * FROM usuarios";

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

                     <a href="../ADMINISTRADOR/registrar_usuarios.php" class="btn btn-primary btn-sm">Añadir</a>
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
                                 <th>NOMBRE DE USUARIO</th>
                                 <th>ROL</th>
                                 <th>PERSONAL</th>
                                 <th>Acciones</th>
                             </thead>
                             <tbody>
                                 <?php while ($row_pacientes = $pacientes->fetch_assoc()) {  ?>

                                     <tr>
                                         <td> <?= $row_pacientes['id_usuario']; ?></td>
                                         <td> <?= $row_pacientes['nombre_usuario']; ?></td>

                                         <?php

                                            $id_rol = $row_pacientes['id_rol'];

                                            $sqlrol = "SELECT * FROM roles where id_rol=$id_rol";
                                            $sqlresultado = mysqli_query($conn, $sqlrol);
                                            $filaresultado = mysqli_fetch_assoc($sqlresultado);


                                            ?>

                                         <td> <?= $filaresultado['nombre']; ?></td>
                                         <td> <?= $row_pacientes['dip_personal']; ?></td>

                                         <td>

                                             <a href="../ADMINISTRADOR/editar_personal.php?id_personal=<?= $row_pacientes['dip_personal'];  ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>




                                         </td>
                                     </tr>


                                 <?php } ?>
                             </tbody>
                             <tfoot>
                                 <th>DIP</th>
                                 <th>NOMBRE DE USUARIO</th>
                                 <th>ROL</th>
                                 <th>PERSONAL</th>
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