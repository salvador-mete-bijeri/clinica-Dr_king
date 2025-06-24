<?php

include 'reporte_general.php';

require '../conexion/conexion.php';


////////////////////------------------------////////
$sql="SELECT * FROM tipo_prueba";
$resultado=mysqli_query($conn,$sql);





$pdf= new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();




$pdf->SetFillColor(228, 100, 0); //colorFondo
$pdf->SetTextColor(255, 255, 255); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$pdf->SetFont('Arial','B',12);
$pdf->Cell(60);
$pdf->cell(90,6,'REPORTE DE LAS PRUEBAS',1,1,'C',1);
$pdf->Ln(5);

$pdf->SetFillColor(228, 100, 0); //colorFondo
$pdf->SetTextColor(255, 255, 255); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFont('Arial','B',12);
$pdf->SetX(65);
$pdf->cell(20,6,'ID',1,0,'C',1);
$pdf->cell(40,6,'NOMBRE',1,0,'C',1);
$pdf->cell(40,6,'PRECIO',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$pdf->SetX(65);

$pdf->SetFillColor(255, 255, 255); //colorFondo
$pdf->SetTextColor(0, 5, 5); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde

while($row= $resultado->fetch_assoc()){
    $pdf->cell(20,6,$row['id_tipo_prueba'],1,0,'C',1);
$pdf->cell(40,6,$row['nombre_prueba'],1,0,'C',1);
$pdf->cell(40,6,$row['precio'],1,1,'C',1);

$pdf->SetX(65);
}












$pdf->Output();






?>