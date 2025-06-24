<?php
$id=$_GET['id'];

require '../conexion/conexion.php';

$sql_editar = "SELECT * FROM citas WHERE id=$id LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);
$codigo = $fila_editar['codigo'];
$paciente=$fila_editar['paciente'];


$sql_paciente = "SELECT * FROM pacientes WHERE id=$paciente LIMIT 1";
$resultado_paciente = mysqli_query($conn, $sql_paciente);
$fila_paciente = mysqli_fetch_assoc($resultado_paciente);




?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Editando la informacion del paciente <span class="text-bold text-primary"> <?php    echo $codigo;       ?> </span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="../php/actualizar_citas.php" id="miFormulario" method="post" enctype="multipart/form-data">


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-5">

                                    <label for="nombre" class="form-label">CODIGO DE PACIENTE</label>
                                    <input type="txt" class="form-control text-bold text-primary" name="doc" id="doc" placeholder="introduce codigo" value=" <?php    echo $codigo;       ?> " required  readonly>
                                    <input type="hidden" name="id" value="<?php    echo $fila_editar['id']; ?>" value="" id="id">
                                </div>


                            </div>


                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <input type="hidden" name="idpaciente" id="idpaciente">
                                    <label for="nombre" class="form-label">NOMBRE</label>
                                    <input type="txt" class="form-control text-bold text-primary" name="nombre" id="nombre" value="  <?php    echo $fila_paciente['nombre'];       ?>  " placeholder="introduce el nombre" readonly required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control text-bold text-primary" name="apellidos" id="apellidos" value="  <?php    echo $fila_paciente['apellidos'];       ?>  " placeholder="introduce el apellido" readonly required>
                                </div>


                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                    <input type="date" class="form-control text-bold text-primary" name="fecha_nacimiento" value="<?php    echo $fila_paciente['fecha_nacimiento']; ?>" id="fecha_nacimiento" readonly required>
                                   
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIP</label>
                                    <input type="text" class="form-control text-bold text-primary" name="dip" id="dip" value="  <?php  echo $fila_paciente['dip']; ?> " placeholder="introduce el dip" readonly required>

                                </div>


                            </div>



                        

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2 text-center">PROXIMA CITA</p>






                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">FECHA DE LA PROXIMA CITA DEL PACIENTE</label>
                                    <input type="date" class="form-control" name="fecha" value="<?php    echo $fila_editar['fecha']; ?>" id="fecha" min="<?php echo date('Y-m-d'); ?>"  required>
                                </div>
                               
                            </div>

                            

                           

                          

                            <div class="row justify-content-center">
                                <div class="modal-footer col-auto">

                                <a href="../DOCTOR/citas.php" class="btn btn-danger m-2 btn-sm">Cancelar</a>
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