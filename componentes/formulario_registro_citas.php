<?php
require '../conexion/conexion.php';
$sql_numero = "SELECT * FROM pacientes ORDER BY id DESC LIMIT 1";
$resultado_numero = mysqli_query($conn, $sql_numero);
$fila_numero = mysqli_fetch_assoc($resultado_numero);
$id_numero = $fila_numero['id'];


?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion del Pacientes</p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion</p>
                    <div class="row">

                        <form action="../php/guardar_citas.php" id="miFormulario" method="post" enctype="multipart/form-data">


                            <div class="d-flex flex-row justify-content-center">

                                <div class="p-2 col-lg-5">

                                    <label for="nombre" class="form-label">CODIGO DE PACIENTE</label>
                                    <input type="txt" class="form-control" name="doc" id="doc" placeholder="introduce codigo" value="CP-" required onblur="buscar_datos();">
                                    <input type="hidden" name="id" id="id">
                                </div>


                            </div>


                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <input type="hidden" name="idpaciente" id="idpaciente">
                                    <label for="nombre" class="form-label">NOMBRE</label>
                                    <input type="txt" class="form-control" name="nombre" id="nombre" placeholder="introduce el nombre" readonly required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="introduce el apellido" readonly required>
                                </div>


                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIP</label>
                                    <input type="text" class="form-control" name="dip" id="dip" placeholder="introduce el dip" readonly required>

                                </div>


                            </div>



                        

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2 text-center">PROXIMA CITA</p>






                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">FECHA DE LA PROXIMA CITA DEL PACIENTE</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" min="<?php echo date('Y-m-d'); ?>"  required>
                                </div>
                               
                            </div>

                            

                           

                          

                            <div class="row justify-content-center">
                                <div class="modal-footer col-auto">

                                <a href="../DOCTOR/citas.php" class="btn btn-danger m-2 btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-primary btn-sm">GUARDAR</button>

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