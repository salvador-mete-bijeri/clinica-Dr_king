<?php
require '../conexion/conexion.php';
$id_filtro=$_GET['id'];

$paciente_id=$_GET['paciente_id'];

$sql_editar = "SELECT * FROM pacientes WHERE id=$paciente_id LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);
$codigo = $fila_editar['codigo'];

$sql_consulta = "SELECT * FROM consultas WHERE id=$id_filtro LIMIT 1";
$resultado_consulta = mysqli_query($conn, $sql_consulta);
$fila_consulta = mysqli_fetch_assoc($resultado_consulta);


$sql_detalle = "SELECT * FROM detalles_consultas WHERE consulta_id=$id_filtro LIMIT 1";
$resultado_detalle = mysqli_query($conn, $sql_detalle);
$fila_detalle = mysqli_fetch_assoc($resultado_detalle);



?> 

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">estas editando la consulta <span class="text-primary"><?php  echo $id_filtro;   ?></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="#" id="miFormulario" method="post" enctype="multipart/form-data">


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-5">

                                    <label for="nombre" class="form-label">CODIGO DE PACIENTE</label>
                                    <input type="txt" class="form-control text-primary text-bold" name="doc" id="doc" placeholder="introduce codigo" value="<?php  echo $codigo;   ?>" required readonly>
                                    <input type="hidden" name="id" id="id">
                                </div>


                            </div>


                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <input type="hidden" name="idpaciente" id="idpaciente">
                                    <label for="nombre" class="form-label">NOMBRE</label>
                                    <input type="txt" class="form-control text-primary text-bold" name="nombre" id="nombre" placeholder="introduce el nombre" value=" <?php  echo $fila_editar['nombre'];   ?>  " readonly required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control text-primary text-bold" name="apellidos" id="apellidos" placeholder="introduce el apellido" value=" <?php  echo $fila_editar['apellidos'];   ?>" readonly required>
                                </div>


                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                    <input type="text" class="form-control text-primary text-bold" name="fecha_nacimiento" id="fecha_nacimiento" value=" <?php  echo $fila_editar['fecha_nacimiento'];  ?> " readonly required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIP</label>
                                    <input type="text" class="form-control text-primary text-bold" name="dip" id="dip" value=" <?php  echo $fila_editar['dip'];   ?>" placeholder="introduce el dip" readonly required>

                                </div>


                            </div>



                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2 text-center">INFORMACION</p>


                            <div class="d-flex flex-row justify-content-center bg-secondary-subtle">
                                <div class="p-2 col-lg-5">
                                    <div class="row">
                                        <label for="edad" class="form-label">ANTECEDENTES PATOLOGICOS</label>
                                    </div>

                                    <div class="row">
                                        <label>
                                            <input type="checkbox" id="checkboxSi"> si
                                        </label>

                                        <div id="antecedentes1" class="hidden">
                                            <label for="miInput">Cual es..?:</label>
                                            <input type="text" class="form-control" id="miInput" name="antecedente" value=" <?php  echo $fila_detalle['antecedente'];   ?>">
                                        </div>
                                        <div id="antecedentes" class="hidden">
                                            <label for="miInput">Tratamiento:</label>
                                            <input type="text" class="form-control" id="miInput" name="antecedentes1" value=" <?php  echo $fila_detalle['antecedentes_patologicos'];   ?>">
                                        </div>

                                    </div>


                                    <label>
                                        <input type="checkbox" name="antecedentes2" value="NO"> No
                                    </label>
                                </div>


                                <div class="p-2 col-lg-5">
                                    <label for="sexo">GRUPO SANGUINEO</label>
                                    <select class="form-control" aria-label=".form-select-lg example" id="grupo_sanguineo"  name="grupo_sanguineo" required value=" <?php  echo $fila_detalle['grupo_sanguineo'];   ?>">
                                        <option selected>Elije uno</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                        <option value="DESCONOCIDO">DESCONOCIDO</option>
                                    </select>
                                </div>


                            </div>




                            <div class="d-flex flex-row justify-content-center bg-secondary-subtle">
                                <div class="p-2 col-lg-5">
                                    <div class="row">
                                        <label for="edad" class="form-label">ALERGIA MEDICAMENTOSA</label>
                                    </div>

                                    <div class="row">
                                        <label>
                                            <input type="checkbox" id="checkbox2Si"> si
                                        </label>

                                        <div id="alergia" class="hidden">
                                            <label for="miInput">Medicamento:</label>
                                            <input type="text" class="form-control" id="miInput" name="alergia1" value=" <?php  echo $fila_detalle['alergia_medi'];   ?>">
                                        </div>

                                    </div>


                                    <label>
                                        <input type="checkbox" name="alergia2" value="NO"> No
                                    </label>
                                </div>


                                <div class="p-2 col-lg-5">
                                    <div class="row">
                                        <label for="edad" class="form-label">VISITA MEDICA ULTIMOS 14 DIAS</label>
                                    </div>

                                    <div class="row">
                                        <label>
                                            <input type="checkbox" id="checkbox3Si" name="visita3" value="SI"> si
                                        </label>

                                        <div id="visita" class="hidden">
                                            <label for="miInput">Diagnostico:</label>
                                            <input type="text" class="form-control" id="miInput" name="visita1">
                                        </div>


                                        <div id="visita2" class="hidden">
                                            <label for="miInput">tratamiento:</label>
                                            <input type="text" class="form-control" id="miInput" name="visita2">
                                        </div>
                                    </div>


                                    <label>
                                        <input type="checkbox" name="visita3" value="NO"> No
                                    </label>
                                </div>

                            </div>



















                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2 text-center">EXPLORACION MEDICA</p>

                            

                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-10">
                                    <label for="hea" class="form-label">HEA:</label>
                                    <textarea class="form-control" name="hea" id="hea" placeholder="HEA" required><?php  echo $fila_consulta['hea'];   ?></textarea>
                                </div>


                            </div>




                            <div class="d-flex flex-row justify-content-center">




                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">PESO</label>
                                    <input type="text" class="form-control" name="peso" id="peso" value="<?php  echo $fila_consulta['peso'];   ?>" placeholder="peso" required>
                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">ALTARA</label>
                                    <input type="text" class="form-control" name="altura" id="altura" value="<?php  echo $fila_consulta['altura'];   ?>" placeholder="altura" required>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">TENSION ARTERIAL</label>
                                    <input type="text" class="form-control" name="tension_arterial"  value="<?php  echo $fila_consulta['tension_arterial'];   ?>" id="tension_arterial" placeholder="Tension arterial" required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="tension" class="form-label">PULSO</label>
                                    <input type="text" class="form-control" name="pulso" id="pulso" value="<?php  echo $fila_consulta['pulso'];   ?>"  placeholder="pulso" required>
                                </div>


                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">TEMPERATURA</label>
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" value="<?php  echo $fila_consulta['temperatura'];   ?>" placeholder="Tension arterial" required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="tension" class="form-label">P02</label>
                                    <input type="text" class="form-control" name="peo" id="peo" value="<?php  echo $fila_consulta['PO2'];   ?>" placeholder="peo" required>
                                </div>


                            </div>


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-10">
                                    <label for="observacion" class="form-label">OBSERVACION DEL MEDICO</label>
                                    <textarea class="form-control" name="observacion" id="observacion" placeholder="observacion" required><?php  echo $fila_consulta['observaciones'];   ?></textarea>
                                </div>

                            </div>







                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2 text-center">OTROS</p>






                            <div class="d-flex flex-row justify-content-center bg-secondary-subtle">

                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">FECHA DE CONSULTA</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php  echo $fila_consulta['fecha'];   ?>" placeholder="fecha" required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="hora" class="form-label">HORA</label>
                                    <input type="time" class="form-control" name="hora" id="hora" value="<?php  echo $fila_consulta['hora'];   ?>" placeholder="hora" required>
                                </div>



                            </div>

                            <div class="d-flex flex-row justify-content-center bg-secondary-subtle">

                                <div class="p-2 col-lg-5">

                                    <label for="precio" class="form-label">PRECIO</label>
                                    <input type="text" class="form-control" name="precio" id="precio" value="<?php  echo $fila_consulta['precio'];   ?>" placeholder="precio" required>

                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">MOTIVO</label>
                                    <textarea class="form-control" name="motivo" id="motivo"  placeholder="motivo" required><?php  echo $fila_consulta['motivo'];   ?></textarea>
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

                                    <a href="../ENFERMERA/consultas.php" class="btn btn-danger m-2 btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-primary btn-sm">ACTUALIZAR</button>

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
                    const checkboxSi = document.getElementById('checkboxSi');
                    const inputContainer = document.getElementById('antecedentes1');


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