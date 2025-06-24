 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';

    $sqlPacientes = "SELECT * FROM consultas";

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

                     <a href="../ADMINISTRADOR/registrar_consultas.php" class="btn btn-primary btn-sm">Añadir</a>
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
                                       
                                        <a href="../ENFERMERA/editar_paciente.php?id=<?= $row_pacientes['id'];  ?>" class="btn btn-sm btn-primary"  ><i class="fas fa-edit"></i></a>
                                      



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
     <script>
         $('#example').DataTable();
     </script>