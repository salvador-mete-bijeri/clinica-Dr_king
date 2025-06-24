<?php
$id_consulta=$_GET['id'];
$codigo=$_GET['codigo'];
$paciente_id=$_GET['paciente_id'];
$fecha=$_GET['fecha'];
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion del Pacientes <span class="text-primary"><?php echo $codigo;     ?></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">
                        <form action="../php/guardar_receta.php" method="post" enctype="multipart/form-data">


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-2">

                                    <label for="dip" class="form-label">CONSULTA</label>
                                    <input type="txt" class="form-control" name="id_consulta" id="id_consulta" placeholder="introduce codigo" value="<?php echo $id_consulta;  ?>" readonly>
                                    <input type="hidden" class="form-control" name="paciente_id" id="paciente_id" placeholder="introduce codigo" value="<?php echo $paciente_id;  ?>" readonly>

                                </div>


                                <div class="p-2 col-lg-2">

                                    <label for="dip" class="form-label">PACIENTE</label>
                                    <input type="txt" class="form-control" name="dip" id="dip" placeholder="introduce codigo" value="<?php echo $codigo;  ?>" readonly>

                                </div>

                                <div class="p-2 col-lg-2">

                                    <label for="fecha" class="form-label">FECHA</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha;  ?>" readonly>

                                </div>




                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="diagnostico" class="form-label">DIAGNOSTICO</label>
                                    <input type="text" class="form-control" name="diagnostico" id="diagnostico"  required>
                                </div>
                               
                            </div>

                            
                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="comentario" class="form-label">COMENTARIO</label>
                                    <input type="text" class="form-control" name="comentario" id="comentario" >
                                </div>
                               
                            </div>


                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-3">
                                    <label for="edad" class="form-label">RECETA</label>
                                    <textarea class="form-control" name="receta" id="receta" rows="10" cols="50" required></textarea>
                                </div>
                                <div class="p-2 col-lg-3">
                                    <label for="instrucciones" class="form-label">INTRUCCIONES DE LA RECETA</label>
                                    <textarea class="form-control" name="instrucciones" id="instrucciones" rows="10" cols="50" required></textarea>
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

                                   
                                    <a href="../DOCTOR/recetas.php" class="btn btn-danger btn-sm">CANCELAR</a>
                                    <button type="submit" class="btn btn-primary btn-sm"> GUARDAR </button>



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