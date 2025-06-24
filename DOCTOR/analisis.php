<?php require '../conexion/conexion.php';

$sql = "SELECT * FROM tipo_prueba";

$resultado = mysqli_query($conn, $sql);


$sql2 = "SELECT * FROM tipo_prueba";

$resultado2 = mysqli_query($conn, $sql2);


$id_consulta = $_GET['id_consulta'];


session_start();
if (!isset($_SESSION['usuario'])) {

    header('Location:../login.php');
}

// tenemos el id del personal atravez de este codigo
$user = $_SESSION['usuario'];

$sql1 = "SELECT id_usuario,id_usuario, dip_personal from usuarios where nombre_usuario='$user'";

$sql1 = "SELECT `usuarios`.`id_usuario`,`usuarios`.`nombre_usuario`, `personal`.`dip_personal`, `personal`.`nombre` FROM `usuarios` LEFT JOIN `personal` ON `usuarios`.`dip_personal` = `personal`.`dip_personal` where `usuarios`.`nombre_usuario`='$user'";

$resultado1 = mysqli_query($conn, $sql1);
$fila = mysqli_fetch_assoc($resultado1);



// // echo $fila['id_personal'] . "</br>";


$id_paciente = $_GET['id_paciente'];
$codigo = $_GET['codigo'];
$id_consulta = $_GET['id_consulta'];
$fecha = $_GET['fecha'];



// echo $id_consulta;











?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">  -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">



    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />



    <script src="../assets/js/jquery.js"></script>




    <style>
        body {
            background-color: #f5f5f5;


        }

        form {
            margin: 50px auto;
        }

        .form-row {
            margin-top: 10px;
        }

        fieldset {
            border: 1px solid #ddd !important;
            margin: 0;
            min-width: 0;
            padding: 30px;
            position: relative;
            border-radius: 4px;
            background-color: #fff;
            padding-left: 10px !important;
        }

        legend {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0px;

            width: 35%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            background-color: #ffffff;
        }

        legend .boton_volver {
            margin-left: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-8">

                <?php
                if (isset($_POST['submit'])) {

                    // obteniedo la hora y la fecha actual







                    ////----////
                    $seleccione = $_POST['durchgefuhrte_arbeiten'];

                    if ($seleccione != "") {





                        foreach ($_POST['durchgefuhrte_arbeiten'] as $key => $value) {

                            $query1 = "INSERT INTO prueba(id_tipo_prueba,id_consulta,dip_personal,paciente,codigo_pac,fecha)VALUES ('" . $_POST['durchgefuhrte_arbeiten'][$key] . "','" . $_POST['von'][$key] . "','" . $_POST['bis'][$key] . "','" . $_POST['std'][$key] .  "','" . $_POST['codigo'][$key] .  "','"  . $fecha . "')";




                            if ($conn->query($query1)) {
                                $id = $conn->insert_id;
                                header('Location: pruebas.php?mensaje=insertado');
                            } else {
                                echo "error de insersion";
                            }
                        }
                    } else {

                        header('Location: analisis.php?mensaje=seleccione');
                    }
                }



                ?>


                <form action="" method="post" enctype="">

                    <fieldset>
                        <legend>BIENVENIDO DOCTOR: <?php echo $fila['nombre']; ?> <a href="consultas.php" class="btn btn-sm btn-primary  boton_volver"> <i class="fas fa-backward"></i> </a> </legend>


                        <div class="row">



                            <div class="col"></div>

                            <div class="col">
                                <h2>CLINICA Dr.King</h2>
                                <p>Direccion. Sampaka</p>
                                <p style="margin-top: -16px;">Tel: 555-971145 / 222-317705</p>
                            </div>



                        </div><br><br>

                        <div class="row">

                            <h5>PRUEBAS:</h5>



                            <?php
                            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'seleccione') {
                            ?>

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-campground"></i>
                                    <strong> Hola!</strong> porfavor seleecione una pueba en todos los campos.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php

                            }

                            ?>


                        </div><br>





                        <div id="dynamic_field">






                            <div class="row mb-2">



                                <div class="col-lg-6 col-md-6">

                                    <select class="form-control" aria-label=".form-select-lg example" id="sexo" name="durchgefuhrte_arbeiten[]" required>
                                        <option selected value="">...seleccione...</option>

                                        <?php

                                        while ($row_consultas = $resultado->fetch_assoc()) { ?>

                                            <option value=" <?php echo  $row_consultas['id'];  ?>  "> <?php echo  $row_consultas['nombre_prueba']; ?> </option>

                                        <?php }  ?>

                                    </select>


                                    <!-- <input type="text" class="form-control" name="durchgefuhrte_arbeiten[]" placeholder="1"> -->
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div>
                                        <input type="hidden" class="form-control" name="von[]" value=" <?php echo $id_consulta;  ?> " readonly>
                                        <input type="text" class="form-control" name="codigo[]" value=" <?php echo $codigo;  ?> " readonly>
                                    </div>

                                    <div class="">
                                        <input type="hidden" class="form-control" name="bis[]" value=" <?php echo $fila['dip_personal']; ?> ">
                                    </div>

                                    <div class="">
                                        <input type="hidden" class="form-control" name="std[]" value=" <?php echo $id_paciente; ?> ">

                                    </div>
                                </div>


                                <div class="col-lg-2 col-md-2">
                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>


                            </div>



                            </div>
                          





                            <br>
                            <div class="form-row"><br>
                                <div class="col">
                                    <button type="submit" id='submit' name="submit" class="btn btn-primary btn-sm" value="Save">GUARDAR </button>
                                </div>
                            </div>
                            <br>
                </form>
                </fieldset>
                </div>
            <div class="col"></div>
        
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->
    <script src="../assets/js/jquery.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="row" id="row' + i + '"> <div class="col-lg-6 col-md-6">    <select class"form-control" name="durchgefuhrte_arbeiten[]" required> <option value="">selecciona..</option>  <?php while ($row_consultas2 = $resultado2->fetch_assoc()) {  ?>  <option value=" <?php echo $row_consultas2['id']; ?> ">   <?php echo $row_consultas2['nombre_prueba']; ?> </option>  <?php }  ?>  </select> </div>  <div class="col-lg-4 col-md-4"> <div class=""> <input type="text" class="form-control" name="von[]" value="<?php echo $id_consulta;  ?>"  readonly > </div>  <div class="col">  <input type="hidden" class="form-control" name="codigo[]" value=" <?php echo $codigo;  ?> " readonly> </div> <div class=""> <input type="hidden" class="form-control" name="bis[]" value="<?php echo $fila['dip_personal']; ?> "> </div>     <div class="">  <input type="hidden" class="form-control" name="std[]" value="<?php echo $id_paciente; ?> "> </div> </div>  <div class="col-lg-2 col-md-2"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");

                $('#row' + button_id + '').remove();
            });



            $('#add2').click(function() {
                i++;
                $('#dynamic_field2').append('<div class="form-row"  id="row2' + i + '"> <div class="col"> <input type="text" class="form-control" name="mange[]"> </div> <div class="col"> <input type="text" class="form-control"  name="bezeichnung[]"> </div> <div class="col"> <input type="text" class="form-control" name="art_nr[]"> </div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove2" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove2', function() {
                var button_id = $(this).attr("id");

                $('#row2' + button_id + '').remove();
            });


            $('#add3').click(function() {
                i++;
                $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <input type="text" class="form-control"  name="offene_pukte[]"> </div> <div class="col"> <input type="text" class="form-control" name="intern[]"> </div> <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove3', function() {
                var button_id = $(this).attr("id");

                $('#row3' + button_id + '').remove();
            });



        });
    </script>

</body>

</html>