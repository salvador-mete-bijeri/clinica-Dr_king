<?php
require '../conexion/conexion.php';
$sql_numero = "SELECT * FROM pacientes ORDER BY id DESC LIMIT 1";
$resultado_numero = mysqli_query($conn, $sql_numero);
$fila_numero = mysqli_fetch_assoc($resultado_numero);
$id_numero = $fila_numero['id'];


if ($id_numero > 0) {

    $id_ultimo = $id_numero + 1;
    $codigo = 'CP-' . $id_ultimo;

} else {

    $codigo = 'CP-1';
}
?> 

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion del Pacientes <span class="text-primary"><?php  echo $codigo;     ?></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="../php/guardar_paciente.php" method="post" enctype="multipart/form-data">

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIP</label>
                                    <input type="number" class="form-control" name="dip" id="dip" placeholder="introduce el dip"  >
                                    

                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="nombre" class="form-label">NOMBRE</label>
                                    <input type="txt" class="form-control" name="nombre" id="nombre" placeholder="introduce el nombre" required>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="introduce el apellido" required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                                </div>
                            </div>


                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2">Contact Information</p>


                            <div class="d-flex flex-row justify-content-center">
                                <div class=" p-2 col-lg-5">
                                    <label for="telefono" class="form-label">TELEFONO</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="introduce el telefono" required>

                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIRECCION</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="introduce la direccion" required>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">TUTOR</label>
                                    <input type="text" class="form-control" name="tutor" id="tutor" placeholder="introduce al tutor" required>
                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="sexo">GENERO</label>
                                    <select class="form-control" aria-label=".form-select-lg example" id="genero" name="genero" required>

                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">EMAIL</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="introduce el Email" >
                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">FECHA DE REGISTRO</label>
                                    <input type="date" class="form-control" name="fecha_registro" id="fecha_registro" required>


                                </div>
                            </div>


                        <div class="row justify-content-center">
                        <div class="modal-footer col-auto">

                          
                            <a href="../ENFERMERA/pacientes.php" class="btn btn-danger m-2 btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary m-2 btn-sm"> Guardar </button>

                        </div>

                    </div>



                        </form>
  
                      
                       
                    </div>
                </div>
            </div>