<?php

include 'reporte_general.php';

require '../conexion/conexion.php';


////////////////////------------------------////////
$sql="SELECT `usuarios`.`id_usuario`, `usuarios`.`nombre_usuario`, `usuarios`.`password_usuario`, `usuarios`.`dip_personal`, `roles`.* FROM `usuarios` LEFT JOIN `roles` ON `usuarios`.`id_rol` = `roles`.`id_rol`;";
$resultado=mysqli_query($conn,$sql);





$pdf= new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60);
$pdf->cell(90,6,'REPORTE DE LOS USUARIOS',1,1,'C',1);
$pdf->Ln(5);

$pdf->SetFillColor(255,255,255);
$pdf->cell(90,14,'',0,1,'C',1);


$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(40);
$pdf->cell(20,6,'ID',1,0,'C',1);
$pdf->cell(40,6,'PERSONAL',1,0,'C',1);
$pdf->cell(40,6,'USUARIO',1,0,'C',1);
$pdf->cell(40,6,'ROL',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$pdf->SetX(40);

while($row= $resultado->fetch_assoc()){
    $pdf->cell(20,6,$row['id_usuario'],1,0,'C',1);
$pdf->cell(40,6,$row['dip_personal'],1,0,'C',1);
$pdf->cell(40,6,$row['nombre_usuario'],1,0,'C',1);
$pdf->cell(40,6,$row['nombre'],1,1,'C',1);
$pdf->SetX(40);
}












$pdf->Output();






?>