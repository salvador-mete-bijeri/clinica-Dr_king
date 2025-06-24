<?php

include 'PruebaH.php';

require '../conexion/conexion.php';


////////////////////------------------------////////
$sql="SELECT * FROM personal";
$resultado=mysqli_query($conn,$sql);





$pdf= new PDF();

$pdf->AliasNbPages();
$pdf->AddPage('landscape');

/* TITULO DE LA TABLA */
      //color
      $pdf->SetTextColor(228, 100, 0);
      $pdf->Cell(100); // mover a la derecha
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Cell(100, 10, utf8_decode("REPORTE DEL PERSONAL "), 0, 1, 'C', 0);
      $pdf->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $pdf->SetFillColor(228, 100, 0); //colorFondo
      $pdf->SetTextColor(255, 255, 255); //colorTexto
      $pdf->SetDrawColor(163, 163, 163); //colorBorde
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(25, 10, utf8_decode('CODIGO'), 1, 0, 'C', 1);
      $pdf->Cell(30, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $pdf->Cell(40, 10, utf8_decode('APELLIDOS'), 1, 0, 'C', 1);
      $pdf->Cell(40, 10, utf8_decode('FECHA_NACIMIENTO'), 1, 0, 'C', 1);
      $pdf->Cell(15, 10, utf8_decode('GENERO'), 1, 0, 'C', 1);
   
      $pdf->Cell(40, 10, utf8_decode('DIRECCION'), 1, 0, 'C', 1);
      $pdf->Cell(40, 10, utf8_decode('TELEFONO'), 1, 0, 'C', 1);
      $pdf->Cell(40, 10, utf8_decode('NACIONALIDAD'), 1, 1, 'C', 1);


      $pdf->SetFont('Arial', '', 10);
      $pdf->SetFillColor(255, 255, 255); //colorFondo
      $pdf->SetTextColor(0, 5, 5); //colorTexto
      $pdf->SetDrawColor(163, 163, 163); //colorBorde


while($row= $resultado->fetch_assoc()){
    $pdf->cell(25,6,$row['dip_personal'],1,0,'C',1);
$pdf->cell(30,6,$row['nombre'],1,0,'C',1);
$pdf->cell(40,6,$row['apellidos'],1,0,'C',1);
$pdf->cell(40,6,$row['fecha_nacimiento'],1,0,'C',1);
$pdf->cell(15,6,$row['genero'],1,0,'C',1);

$pdf->cell(40,6,$row['direccion'],1,0,'C',1);
$pdf->cell(40,6,$row['telefono'],1,0,'C',1);
$pdf->cell(40,6,$row['nacionalidad'],1,1,'C',1);

}










$pdf->Output('Prueba2.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)








?>