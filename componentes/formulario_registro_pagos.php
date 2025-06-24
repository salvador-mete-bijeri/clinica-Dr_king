<?php
$id_prueba = $_GET['id_prueba'];
echo $id_prueba;
$id_tipo_prueba = $_GET['id_tipo_prueba'];


$codigo = $_GET['codigo'];

require '../conexion/conexion.php';

$sql_editar = "SELECT * FROM pacientes WHERE codigo='{$codigo}' LIMIT 1";
$resultado_editar = mysqli_query($conn, $sql_editar);
$fila_editar = mysqli_fetch_assoc($resultado_editar);


$fecha = date('Y-m-d');

$sql_editar2 = "SELECT * FROM tipo_prueba WHERE id=$id_tipo_prueba LIMIT 1";
$resultado_editar2 = mysqli_query($conn, $sql_editar2);
$fila_editar2 = mysqli_fetch_assoc($resultado_editar2);



$sql_prueba = "SELECT * FROM pagos WHERE id_prueba=$id_prueba LIMIT 1";
$resultado_prueba = mysqli_query($conn, $sql_prueba);
$pago=mysqli_num_rows($resultado_prueba);
$fila_prueba = mysqli_fetch_assoc($resultado_prueba);

if($pago>0){

  $pagado=$fila_prueba['cantidad'];

  $tipo='readonly';

}else{
  
 
  $pagado='';
  $tipo='';

}



?>

<div class="row">

  <form action="../php/guardar_pagos.php" method="post" enctype="multipart/form-data">


    <div class="d-flex flex-row justify-content-center">

      <div class="p-1 col-lg-4">

        <label for="dip" class="form-label">NOMBRE</label>
        <input type="txt" class="form-control" name="nombre" id="nombre" placeholder="introduce codigo" value="<?php echo $fila_editar['nombre'];  ?>" readonly>
        <input type="hidden" class="form-control" name="id_prueba" id="id_prueba" placeholder="introduce codigo" value="<?php echo $id_prueba;  ?>" readonly>
        <input type="hidden" class="form-control" name="id_tipo_prueba" id="id_tipo_prueba" placeholder="introduce codigo" value="<?php echo $fila_editar2['id'];  ?>" readonly>

      </div>


      <div class="p-1 col-lg-4">

        <label for="dip" class="form-label">CODIGO</label>
        <input type="txt" class="form-control" name="dip" id="dip" placeholder="introduce codigo" value="<?php echo $fila_editar['codigo'];  ?>" readonly>

      </div>

      <div class="p-1 col-lg-4">

        <label for="fecha" class="form-label">FECHA</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha;  ?>" readonly>

      </div>




    </div>


    <div class="d-flex flex-row justify-content-center">
      <div class="p-1 col-lg-4">
        <label for="edad" class="form-label">PRUEBA</label>
        <input type="txt" class="form-control text-bold text-success" name="dip" id="dip" placeholder="introduce codigo" value="<?php echo $fila_editar2['nombre_prueba'];  ?>" readonly>
      </div>
      <div class="p-1 col-lg-4">
        <label for="instrucciones" class="form-label">PRECIO DE LA PRUEBA</label>
        <input type="txt" class="form-control text-bold text-danger" name="precio" id="precio" placeholder="introduce codigo" value="<?php echo $fila_editar2['precio'];  ?>" readonly>
      </div>

      <div class="p-1 col-lg-4">
        <label for="pago" class="form-label">PAGO</label>
        <input type="number" class="form-control text-bold text-primary" name="pago" id="pago" value="<?php echo $pagado ?>" placeholder="introduce el pago" required <?php echo $tipo;?>>
        <p id="mensaje" class="text-bold"></p>

      </div>
    </div>



  



    <div class="row justify-content-center">



      <div class="modal-footer col-auto">


        <a href="../ADMINISTRADOR/pruebas.php" class="btn btn-danger btn-sm">CANCELAR</a>
        <button type="submit" class="btn btn-primary btn-sm"> GUARDAR </button>



      </div>



    </div>


  </form>







</div>

<script>
  // Obtener referencias a los elementos input y al párrafo
  var input1 = document.getElementById("precio");
  var input2 = document.getElementById("pago");
  var mensaje = document.getElementById("mensaje");


  // Agregar un evento de input a ambos campos
  input1.addEventListener("input", validarContenido);
  input2.addEventListener("input", validarContenido);

  // Función para validar el contenido de ambos campos
  function validarContenido() {
    // Obtener el valor de ambos campos
    var valorInput1 = input1.value;
    var valorInput2 = input2.value;

    // Verificar si los valores son iguales
    if (valorInput1 === valorInput2) {
      mensaje.textContent = "Los contenidos son iguales.";
    } else {
      mensaje.textContent = "Los contenidos no son iguales.";
    }
  }
</script>