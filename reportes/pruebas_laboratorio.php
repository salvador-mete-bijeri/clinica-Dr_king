<?php

include 'PruebaV_corto.php';

require '../conexion/conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {

  header('Location: ../index.php');
}





// obteniedo la hora y la fecha actual


date_default_timezone_set('America/Mexico_City');

$fecha_actual = getdate();



$fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];


/////////=========



// $dip_filtro=$_POST['dip'];
// $fecha_filtro=$_POST['fecha'];


$codigo_filtro = $_POST['codigo'];
$fecha_filtro = $_POST['fecha'];







$sql = "SELECT * FROM prueba where TRIM(codigo_pac)='$codigo_filtro' and fecha='$fecha_filtro'";
$resultado = mysqli_query($conn, $sql);
$numero_consulta = mysqli_num_rows($resultado);


if ($numero_consulta < 1) {
  header('Location: ../DOCTOR/pruebas.php?mensaje=codigo');
}












// $fila=mysqli_fetch_assoc($resultado);

// imprimimos los datos del paciente segun el dip
$sql1 = "SELECT * FROM prueba";
$resultado1 = mysqli_query($conn, $sql1);
$fila1 = mysqli_fetch_assoc($resultado1);
$dip = $fila1['paciente'];

$sql2 = "SELECT * FROM pacientes where id=$dip limit 1";
$resultado2 = mysqli_query($conn, $sql2);
$fila2 = mysqli_fetch_assoc($resultado2);




$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();





// color a las celdas
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetX(20);
$pdf->cell(30, 6, 'Paciente:', 0, 0, 'L', 1);


$pdf->SetFont('Arial', 'b', 10);
// encabezados


$hoy = date('d/m/Y');

$pdf->SetX(50);

$pdf->cell(25, 6, $fila2['nombre'], 0, 0, 'L', 1);
$pdf->cell(30, 6, $fila2['apellidos'], 0, 1, 'L', 1);

$pdf->SetFont('Arial', '', 10);
$pdf->SetX(20);
$pdf->cell(30, 6, 'Solicitud:', 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->cell(30, 6, 'Fecha:', 0, 0, 'L', 1);

$pdf->SetX(44);
$pdf->Cell(30, 6, utf8_decode($hoy), 0, 1, 'C'); // pie de pagina(fecha de pagina)



$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetY(60);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(90, .01, '', 1, 1, 'L', 1);
$pdf->Ln(5);


$pdf->SetFont('Arial', '', 10);
// TITULO
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(20);
$pdf->SetFont('Arial', '', 10);



$pdf->Ln(5);


//aqui empeieza la tabla



$pdf->SetFont('Arial', '', 10);


$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(20);
$pdf->Cell(40, 5, 'Prueba', 0, 0, 'L', 1);
$pdf->SetX(70);
$pdf->Cell(40, 5, 'Resultado', 0, 0, 'L', 1);
$pdf->Cell(40, 5, 'Unidades', 0, 0, 'L', 1);
$pdf->Cell(40, 5, 'Valores de referencia', 0, 1, 'L', 1);


$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(170, .05, '', 1, 1, 'L', 1);
$pdf->Ln(25);



$pdf->SetFillColor(255, 255, 255);
while ($row_prueba = $resultado->fetch_assoc()) {

  $pdf->SetFont('Arial', 'B', 9);




  $id_tipo_prueba = $row_prueba['id_tipo_prueba'];

  $sql3 = "SELECT * FROM tipo_prueba where id=$id_tipo_prueba limit 1";
  $resultado3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($resultado3);


  $pdf->SetFont('Arial', '', 9);
  $pdf->SetX(20);

  $pdf->Cell(40, 5, $row3['nombre_prueba'], 0, 0, 'L', 1);



  $pdf->SetFillColor(255, 255, 255);
  $respuesta = $row_prueba['resultado'];
  if ($respuesta == "") {
    $pdf->SetX(70);
    $pdf->Cell(40, 5, 'en espera', 0, 1, 'L', 1);


  } else {
    $pdf->SetX(70);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(40, 5, $row_prueba['resultado'], 0, 1, 'L', 1);
    $pdf->SetTextColor(0, 0, 0);
  }
}




// while ($row_prueba = $resultado->fetch_assoc()) {



//   $id_tipo_prueba = $row_prueba['id_tipo_prueba'];

//   $sql3 = "SELECT * FROM tipo_prueba where id=$id_tipo_prueba limit 1";
//   $resultado3 = mysqli_query($conn, $sql3);
//   $row3 = mysqli_fetch_assoc($resultado3);



//   $pdf->SetFont('Arial', '', 9);
//   $pdf->SetX(20);
//   $pdf->Cell(40, 5, $row3['nombre_prueba'], 0, 0, 'L', 1);

//   $resultado = $row_prueba['resultado'];
//   if ($resultado == "") {
//       $pdf->SetX(80);
//       $pdf->Cell(100, 5, 'en espera', 0, 1, 'L', 1);
//   } else {
//       $pdf->SetTextColor(255, 0, 0);
//       $pdf->Cell(100, 5, $row_prueba['resultado'], 0, 1, 'L', 1);
//       $pdf->SetTextColor(0, 0, 0);
//   }
// }




$pdf->Output();
