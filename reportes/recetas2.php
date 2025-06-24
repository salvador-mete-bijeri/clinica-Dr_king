<?php

include 'PruebaV_corto.php';

require '../conexion/conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {

  header('Location: ../index.php');
}


$id_receta = $_GET['id_receta'];
$codigo= $_GET['codigo'];


$sql = "SELECT * FROM receta where id_receta=$id_receta limit 1";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);






// $fila=mysqli_fetch_assoc($resultado);

// imprimimos los datos del paciente segun el dip


$sql2 = "SELECT * FROM pacientes where codigo='$codigo' limit 1";
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


$pdf->SetFont('Arial', 'B', 10);
// encabezados


$hoy = date('d/m/Y');

$pdf->SetX(50);

$pdf->cell(25, 6, $fila2['nombre'], 0, 0, 'L', 1);
$pdf->cell(30, 6, $fila2['apellidos'], 0, 1, 'L', 1);

$pdf->SetX(20);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(30, 6, 'EMPRESA:', 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->cell(30, 6, 'FECHA:', 0, 0, 'L', 1);

$pdf->SetX(44);
$pdf->Cell(30, 6, utf8_decode($hoy), 0, 1, 'C'); // pie de pagina(fecha de pagina)



$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetY(60);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(100, .05, '', 1, 1, 'L', 1);
$pdf->Ln(5);



// TITULO
$pdf->SetFillColor(232, 232, 232);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(20);
$pdf->SetFont('Arial', '', 10);
$pdf->cell(100, .2, 'Solicitud', 0, 1, 'L', 1);

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 9);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetY(75);
$pdf->SetX(20);
$pdf->MultiCell(80, 6, $row['descripcion_receta'], 1, 0, 'L', 1);
$pdf->SetY(75);
$pdf->SetX(110);
$pdf->MultiCell(80, 6, $row['instrucciones_receta'], 1, 1, 'L', 1);


$pdf->Ln(5);


//aqui empeieza la tabla



$pdf->SetFont('Arial', 'B', 11);





// encabezados
// $pdf->SetX(20);
// $pdf->cell(50, 6, $row3['nombre_prueba'], 0, 0, 'L', 1);



$pdf->Output();
