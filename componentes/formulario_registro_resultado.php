<?php
$id_prueba = $_GET['id_prueba'];
$id_tipo_prueba = $_GET['id_tipo_prueba'];

require '../conexion/conexion.php';

$sql_editar = "SELECT * FROM tipo_prueba WHERE id=$id_tipo_prueba LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);





$sql_editar2 = "SELECT * FROM prueba WHERE id_prueba=$id_prueba LIMIT 1";
$resultado_editar2 = mysqli_query($conn, $sql_editar2);
$fila_editar2 = mysqli_fetch_assoc($resultado_editar2);

$resultado= $fila_editar2['resultado'];

echo $resultado;


if ($resultado!=''){
    $input='readonly';
    $boton='disabled';
}else{
    
    $input= '';
    $boton='';
}






$fecha = date('Y-m-d');







?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion de la prueba <span class="text-primary"><?php echo $id_prueba;     ?></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">
                        <form action="../php/guardar_resultado.php" method="post" enctype="multipart/form-data">


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-1 col-lg-3">

                                    <label for="dip" class="form-label">PRUEBA</label>
                                    <input type="txt" class="form-control" name="id_consulta" id="id_consulta" placeholder="introduce codigo" value="<?php echo $fila_editar['nombre_prueba'];  ?>" readonly required>
                                    <input type="hidden" class="form-control" name="id_prueba" id="id_prueba" placeholder="introduce codigo" value="<?php echo $id_prueba;  ?>" readonly required>

                                </div>


                                <div class="p-1 col-lg-3">

                                    <label for="dip" class="form-label">RESULTADO</label>
                                    <input type="text" class="form-control" name="resultado" id="resultado" placeholder="introduce el resultado" value="<?php echo $resultado;  ?>" required  <?php echo $input;  ?>>

                                </div>

                                <div class="p-2 col-lg-2">

                                    <label for="fecha" class="form-label">FECHA</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha;  ?>" readonly>

                                </div>



                            </div>



                            <div class="row justify-content-center">

                                <div class="p-1 col-lg-5">

                                    <label for="dip" class="form-label text-center">VALORES DE REFERENCIA</label>
                                    <textarea class="form-control" name="referencia" id="referencia" cols="30" rows="5" ></textarea>

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



                                <div class="modal-footer col-auto">


                                    <a href="../LABORATORIO/pruebas.php" class="btn btn-danger btn-sm">CANCELAR</a>
                                    <button type="submit" class="btn btn-primary btn-sm" <?php echo $boton;  ?>> GUARDAR </button>



                                </div>



                            </div>


                        </form>



                    </div>
                </div>
            </div>




            <!-- coger los datos para editarlos en el modal -->
            <script type="text/javascript">
                function buscar_datos() {

                    doc = $("#doc").val();

                    var parametros = {
                        "buscar": "1",
                        "doc": doc

                    };

                    $.ajax({
                        data: parametros,
                        dataType: 'json',
                        url: 'codigos.php',
                        type: 'POST',

                        error: function() {
                            alert("no se encontro este codigo");
                        },

                        success: function(valores)

                        {
                            doc = $("#nombre").val(valores.nombre);
                            doc = $("#apellidos").val(valores.apellidos);
                            doc = $("#fecha_nacimiento").val(valores.fecha_nacimiento);
                            doc = $("#dip").val(valores.dip);
                            doc = $("#id").val(valores.id);


                        }

                    })



                }
            </script>




            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxSi = document.getElementById('checkboxSi');
                    const inputContainer = document.getElementById('antecedentes');

                    function actualizarVisibilidadInput() {
                        inputContainer.classList.toggle('hidden', !checkboxSi.checked);
                    }

                    checkboxSi.addEventListener('change', actualizarVisibilidadInput);

                    // Llamar a la función al inicio para establecer la visibilidad inicial
                    actualizarVisibilidadInput();
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxSi = document.getElementById('checkbox2Si');
                    const inputContainer = document.getElementById('alergia');

                    function actualizarVisibilidadInput() {
                        inputContainer.classList.toggle('hidden', !checkboxSi.checked);
                    }

                    checkboxSi.addEventListener('change', actualizarVisibilidadInput);

                    // Llamar a la función al inicio para establecer la visibilidad inicial
                    actualizarVisibilidadInput();
                });
            </script>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxSi = document.getElementById('checkbox3Si');
                    const inputContainer = document.getElementById('visita');

                    function actualizarVisibilidadInput() {
                        inputContainer.classList.toggle('hidden', !checkboxSi.checked);
                    }

                    checkboxSi.addEventListener('change', actualizarVisibilidadInput);

                    // Llamar a la función al inicio para establecer la visibilidad inicial
                    actualizarVisibilidadInput();
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxSi = document.getElementById('checkbox3Si');
                    const inputContainer = document.getElementById('visita2');

                    function actualizarVisibilidadInput() {
                        inputContainer.classList.toggle('hidden', !checkboxSi.checked);
                    }

                    checkboxSi.addEventListener('change', actualizarVisibilidadInput);

                    // Llamar a la función al inicio para establecer la visibilidad inicial
                    actualizarVisibilidadInput();
                });
            </script>