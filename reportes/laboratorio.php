<?php

include 'PruebaV_corto.php';

require '../conexion/conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {

  header('Location: ../index.php');
}


$id_prueba = $_GET['id_prueba'];


$sql = "SELECT * FROM prueba where id_prueba=$id_prueba limit 1";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);

$id_tipo_prueba = $row['id_tipo_prueba'];

$sql3 = "SELECT * FROM tipo_prueba where id=$id_tipo_prueba limit 1";
$resultado3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($resultado3);


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
$pdf->cell(30, 6, 'Empresa:', 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->cell(30, 6, 'Fecha:', 0, 0, 'L', 1);

$pdf->SetX(44);
$pdf->Cell(30, 6, utf8_decode($hoy), 0, 1, 'C'); // pie de pagina(fecha de pagina)



$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetY(60);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(100, .05, '', 1, 1, 'L', 1);
$pdf->Ln(10);


$pdf->SetFont('Arial', '', 10);
// TITULO
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(20);
$pdf->SetFont('Arial', '', 10);
$pdf->cell(100, .2, 'Solicitud', 0, 1, 'L', 1);


$pdf->Ln(5);


//aqui empeieza la tabla



$pdf->SetFont('Arial', '', 10);





// encabezados
$pdf->SetX(20);
$pdf->cell(70, 5, $row3['nombre_prueba'], 0, 0, 'L', 1);
$resultado=$row['resultado'];

if($resultado!=''){
  $pdf->cell(50, 5, $row['resultado'], 0, 1, 'L', 1);
}else{
 
  
  $pdf->cell(50, 5,'en espera', 0, 1, 'L', 1);
}





$pdf->Output();
