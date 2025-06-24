<?php
require '../conexion/conexion.php';
$id_filtro = $_GET['id'];
$sql_editar = "SELECT * FROM tipo_prueba WHERE id=$id_filtro LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);
$codigo = $fila_editar['id'];



?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion de la prueba <span class="text-primary"><?php echo $codigo;     ?></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="../php/actualizar_pruebas.php" method="post" enctype="multipart/form-data">




                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-5">

                                    <label for="nombre_usuario" class="form-label">NOMBRE DE LA PRUEBA</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $fila_editar['nombre_prueba'];  ?>" placeholder="NOMBRE DE LA PRUEBA" required>
                                <input type="hidden" name="id" value="<?php echo $fila_editar['id'];  ?>">
                                </div>

                                <div class="p-2 col-lg-5">

                                    <label for="nombre_usuario" class="form-label">PRECIO</label>
                                    <input type="number" class="form-control" name="precio" id="precio" value="<?php echo $fila_editar['precio'];  ?>" placeholder="PRECIO DE LA PRUEBA" required>
                                </div>





                            </div>





                            <div class="row justify-content-center">
                                <div class=" modal-footer col-auto">


                                    <a href="../ADMINISTRADOR/tipo_pruebas.php" class="btn btn-danger btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>

                                </div>

                            </div>


                        </form>


                    </div>
                </div>
            </div>