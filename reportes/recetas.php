<?php

include 'PruebaV.php';

require '../conexion/conexion.php';

 // obteniedo la hora y la fecha actual


 date_default_timezone_set('America/Mexico_City');

 $fecha_actual = getdate();
 

 
  $fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];


 /////////=========



$dip_filtro=$_POST['dip'];
$fecha_filtro=$_POST['fecha'];







$sql_filtro="SELECT * FROM receta where dip=$dip_filtro and fecha='${fecha_filtro}'";
$resultado_filtro=mysqli_query($conn,$sql_filtro);

$sql_filtro1="SELECT * FROM receta where dip=$dip_filtro and fecha='${fecha_filtro}'";
$resultado_filtro1=mysqli_query($conn,$sql_filtro1);



////////////////////------------------------////////
$sql2="SELECT * FROM pacientes where dip=$dip_filtro limit 1";
$resultado2=mysqli_query($conn,$sql2);
$fila2=mysqli_fetch_assoc($resultado2);


////////////////////------------------------////////
$sql2="SELECT * FROM pacientes where dip=$dip_filtro limit 1";
$resultado2=mysqli_query($conn,$sql2);
$fila2=mysqli_fetch_assoc($resultado2);

$filas= $resultado2->num_rows;

if($filas<1){
    header('Location: ../ADMINISTRADOR/PEDIATRIA/recetas.php?mensaje=nada');
    
}



$pdf= new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();



// LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(100,.2,'',1,1,'L',1);
$pdf->Ln(2);

// color a las celdas
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','',13);
$pdf->SetX(20);
$pdf->cell(30,6,'PACIENTE',0,1,'L',1);
$pdf->Ln(2);



$pdf->SetFont('Arial','',10);
// encabezados



 $pdf->SetX(20);
 $pdf->cell(45,6,'CODIGO:',0,0,'L',1);
 $pdf->cell(45,6,$fila2['dip'],0,1,'L',1);
 

 $pdf->SetX(20);
 $pdf->cell(45,6,'NOMBRE:',0,0,'L',1);
 $pdf->cell(45,6,$fila2['nombre'],0,1,'L',1);
 $pdf->SetX(20);
 $pdf->cell(45,6,'FECHA DE NACIMIENTO:',0,0,'L',1);
 $pdf->cell(45,6,$fila2['fecha_nacimiento'],0,1,'L',1);
 $pdf->SetX(20);
$pdf->cell(45,6,'FECHA:',0,0,'L',1);
$pdf->cell(45,6,$fecha_actual_completa,0,1,'L',1);




$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(100,.2,'',1,1,'L',1);
$pdf->Ln(10);


// TITULO
$pdf->SetFillColor(232,232,232);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(85);
$pdf->SetFont('Arial','',13);
$pdf->cell(100,.2,'RECETA',0,1,'L',1);

// color a las celdas
$pdf->SetFillColor(250,250,250);

$pdf->Ln(10);


// encabezados

// $pdf->SetY(155);
// $pdf->cell(50,6,'DESCRIPCION',1,1,'L',1);


// $pdf->SetY(170);
$pdf->SetFont('Arial','B',10);
while($row_filtro= $resultado_filtro->fetch_assoc()){
  
    $pdf->SetX(50);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['descripcion_receta'],1,1,'L',1); 
    $pdf->SetX(50);
}

$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
$pdf->cell(50,6,'INSTRUCCIONES',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);

$pdf->Ln(5);

while($row_filtro1= $resultado_filtro1->fetch_assoc()){


        $pdf->SetTextColor(255, 87, 51 );
        $pdf->SetX(50);
        $pdf->MultiCell(100,10,$row_filtro1['instrucciones_receta'],1,1,'L',1);
        $pdf->SetX(50);
      

    
   
}
$pdf->SetTextColor(0, 0, 0);




$pdf->Output();






?>