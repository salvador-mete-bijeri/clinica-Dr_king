<?php

require '../conexion/conexion.php';

$sqlPacientes = "SELECT * FROM roles";

$pacientes = $conn->query($sqlPacientes);




?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Registro de Usuarios <span class="text-primary">hola</span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="../php/guardar_usuario.php" method="post" enctype="multipart/form-data">




                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-5">

                                    <label for="nombre_usuario" class="form-label">CODIGO DEL PERSONAL</label>
                                    <input type="txt" class="form-control" name="dip_personal" id="dip_personal" placeholder="ID - PERSONAL" required>
                                </div>

                                <div class="p-2 col-lg-5">

                                    <label for="nombre_usuario" class="form-label">NOMBRE DE USUARIO</label>
                                    <input type="txt" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="NOMBRE DE USUARIO" required>
                                </div>





                            </div>




                            <div class="d-flex flex-row justify-content-center">




                                <div class="p-2 col-lg-5">

                                    <label for="nombre" class="form-label">PASSWORD</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                                </div>


                                <div class="p-2 col-lg-5">
                                    <label for="nombre" class="form-label">ROL</label>
                                    <select class="form-control" aria-label=".form-select-lg example" id="rol" name="rol" required>
                                        <option selected value="">seleccione.....</option>

                                        <?php

                                        while ($row_consultas = $pacientes->fetch_assoc()) { ?>

                                            <option value=" <?php echo  $row_consultas['id_rol'];  ?>  "> <?php echo  $row_consultas['nombre']; ?> </option>

                                        <?php }  ?>

                                    </select>
                                </div>

                            </div>







                            <!-- 

<div class="d-flex flex-row justify-content-center">
    <div class="p-2 col-lg-5">
        <label for="edad" class="form-label">ACTIVO</label>
        <select class="form-control" aria-label=".form-select-lg example" id="activo" name="activo" required>
            <option selected>Elije el sexo</option>
            <option value="">M</option>
            <option value="">F</option>
        </select>
    </div>
    <div class="p-2 col-lg-5">
        <label for="fecha" class="form-label">OBSERVACIONES</label>
        <input type="text" class="form-control" name="observacion" id="observacion" placeholder="observacion" required>
    </div>
</div>



   -->





                            <div class="row justify-content-center">
                                <div class=" modal-footer col-auto">

                                    
                                    <a href="../ADMINISTRADOR/usuarios.php" class="btn btn-danger btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">GUARDAR</button>

                                </div>

                            </div>


                        </form>


                    </div>
                </div>
            </div>