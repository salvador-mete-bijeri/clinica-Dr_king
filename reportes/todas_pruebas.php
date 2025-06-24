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







$sql_filtro="SELECT `prueba`.`id_prueba`,`prueba`.`resultado`,`prueba`.`dip`, `tipo_prueba`.`nombre_prueba`, `tipo_prueba`.`precio`, `prueba`.`fecha` FROM `prueba` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id_tipo_prueba` where  dip=$dip_filtro and fecha='${fecha_filtro}'";
$resultado_filtro=mysqli_query($conn,$sql_filtro);


///=========

$sql_filtro1="SELECT `prueba`.`id_prueba`,`prueba`.`resultado`,`prueba`.`dip`, `tipo_prueba`.`nombre_prueba`, `tipo_prueba`.`precio`, `prueba`.`fecha` FROM `prueba` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id_tipo_prueba` where   dip=$dip_filtro and fecha='${fecha_filtro}'";
$resultado_filtro1=mysqli_query($conn,$sql_filtro1);


///====
$sql_filtro2="SELECT `prueba`.`id_prueba`,`prueba`.`resultado`,`prueba`.`dip`, `tipo_prueba`.`nombre_prueba`, `tipo_prueba`.`precio`, `prueba`.`fecha` FROM `prueba` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id_tipo_prueba` where  dip=$dip_filtro and fecha='${fecha_filtro}'";
$resultado_filtro2=mysqli_query($conn,$sql_filtro2);








////////////////////------------------------////////
$sql2="SELECT * FROM pacientes where dip=$dip_filtro limit 1";
$resultado2=mysqli_query($conn,$sql2);
$fila2=mysqli_fetch_assoc($resultado2);




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
 $pdf->cell(30,6,$fila2['dip'],0,1,'L',1);
 

 $pdf->SetX(20);
 $pdf->cell(45,6,'NOMBRE:',0,0,'L',1);
 $pdf->cell(30,6,$fila2['nombre'],0,1,'L',1);
 $pdf->SetX(20);
 $pdf->cell(45,6,'FECHA DE NACIMIENTO:',0,0,'L',1);
 $pdf->cell(30,6,$fila2['fecha_nacimiento'],0,1,'L',1);
 $pdf->SetX(20);
$pdf->cell(45,6,'FECHA:',0,0,'L',1);
$pdf->cell(30,6,$fecha_actual_completa,0,1,'L',1);




$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(100,.2,'',1,1,'L',1);
$pdf->Ln(10);


// TITULO
$pdf->SetFillColor(232,232,232);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(80);
$pdf->SetFont('Arial','',13);
$pdf->cell(100,.2,'PRUEBAS DE LABORATORIO',0,1,'L',1);


$pdf->Ln(20);







/// AQUI IMPRIMIMOS EL RESULTADO





//aqui empeieza la tabla

// color a las celdas
$pdf->SetFillColor(250,250,250);


$pdf->SetFont('Arial','B',12);










// encabezados
$pdf->SetX(20);
$pdf->SetY(190);
$pdf->cell(50,6,'PRUEBA',1,1,'L',1);
$pdf->SetY(200);

$pdf->SetFont('Arial','B',10);
while($row_filtro= $resultado_filtro->fetch_assoc()){
   
    $pdf->cell(50,6,$row_filtro['nombre_prueba'],0,1,'L',1); 
}

$pdf->SetY(190);
$pdf->SetX(65);
$pdf->cell(50,6,'RESULTADO',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(200);

while($row_filtro1= $resultado_filtro1->fetch_assoc()){

    $resultado=$row_filtro1['resultado'];

    if($resultado=="POSITIVO"){
        $pdf->SetTextColor(255, 87, 51 );
        $pdf->SetX(80);
        $pdf->cell(50,6,$row_filtro1['resultado'],0,1,'L',1);
        $pdf->SetX(80);
      
    }else{
       
        $pdf->SetTextColor(0, 0,0 );
        $pdf->SetX(80);
        $pdf->cell(50,6,$row_filtro1['resultado'],0,1,'L',1);
        $pdf->SetX(80);
    }


    

    
    
   
}

$pdf->SetY(190);
 $pdf->SetX(125);
 $pdf->SetTextColor(0, 0,0 );
 $pdf->cell(70,6,'PRECIO',1,1,'L',1);
 $pdf->SetY(200);
 $pdf->SetX(125);
 $pdf->SetFont('Arial','B',10);
 while($row_filtro2= $resultado_filtro2->fetch_assoc()){
    $pdf->SetX(125);
    $precio=$row_filtro2['precio'];
    

    if($precio!=0){
        $pdf->SetX(125);
        $pdf->SetTextColor(255, 87, 51 );
        $pdf->cell(50,6,$row_filtro2['precio'],0,1,'L',1); 
        $pdf->SetX(125);
      
    }else{
        $pdf->SetTextColor(0, 0, 0 );
        $pdf->cell(50,6,'0.000',0,1,'L',1); 
        $pdf->SetX(125);
    }
    
     
    
 }


 $pdf->SetTextColor(0, 0, 0 );




$pdf->Output();






?>