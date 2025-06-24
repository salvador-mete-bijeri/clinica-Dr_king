<?php

include 'PruebaV.php';

require '../conexion/conexion.php';

 // obteniedo la hora y la fecha actual


 date_default_timezone_set('America/Mexico_City');

 $fecha_actual = getdate();
 

 
  $fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];


 /////////=========



// $dip_filtro=$_POST['dip'];
// $fecha_filtro=$_POST['fecha'];


$dip_filtro=$_POST['dip'];





$sql_consulta="SELECT * FROM consultas where dip=$dip_filtro";
$resultado_filtro=mysqli_query($conn,$sql_consulta);

// $sql_filtro1="SELECT * FROM receta where dip=$dip_filtro and fecha='${fecha_filtro}'";
// $resultado_filtro1=mysqli_query($conn,$sql_filtro1);

$sql_prueba="SELECT `prueba`.*, `tipo_prueba`.* FROM `prueba` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id_tipo_prueba` where dip=$dip_filtro";
$resultado_prueba=mysqli_query($conn,$sql_prueba);




$sql_receta="SELECT * FROM receta where dip=$dip_filtro";
$resultado_receta=mysqli_query($conn,$sql_receta);

$sql_ingreso="SELECT * FROM ingresos where estado=0 and dip=$dip_filtro";
$resultado_ingreso=mysqli_query($conn,$sql_ingreso);

$sql_alta="SELECT * FROM altas where  dip=$dip_filtro";
$resultado_alta=mysqli_query($conn,$sql_alta);


$sql_citas="SELECT * FROM citas where  dip=$dip_filtro";
$resultado_citas=mysqli_query($conn,$sql_citas);



////////////////////------------------------////////
$sql2="SELECT * FROM pacientes where dip=$dip_filtro limit 1";
$resultado2=mysqli_query($conn,$sql2);
$fila2=mysqli_fetch_assoc($resultado2);

$filas= $resultado2->num_rows;

if($filas<1){
    header('Location: ../ADMINISTRADOR/index.php?mensaje=nada');
    
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
$pdf->SetFillColor(133,193,233);

$pdf->SetFont('Arial','',13);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(30,6,'PACIENTE',0,1,'L',1);
$pdf->Ln(2);



$pdf->SetFont('Arial','B',10);
// encabezados



 $pdf->SetX(20);
 $pdf->cell(45,6,'CODIGO:',0,0,'L',1);
 $pdf->SetTextColor(0, 0, 0);
 $pdf->cell(45,6,$fila2['dip'],0,1,'L',1);
 

 $pdf->SetX(20);
 $pdf->SetTextColor(0, 0, 0);
 $pdf->cell(45,6,'NOMBRE:',0,0,'L',1);
 $pdf->SetTextColor(0, 0, 0);
 $pdf->cell(45,6,$fila2['nombre'],0,1,'L',1);
 $pdf->SetX(20);
 $pdf->SetTextColor(0, 0, 0);
 $pdf->cell(45,6,'FECHA DE NACIMEINTO:',0,0,'L',1);
 $pdf->SetTextColor(0, 0, 0);
 $pdf->cell(45,6,$fila2['fecha_nacimiento'],0,1,'L',1);
 $pdf->SetX(20);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(45,6,'FECHA:',0,0,'L',1);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45,6,$fecha_actual_completa,0,1,'L',1);




$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(100,.2,'',1,1,'L',1);
$pdf->Ln(10);




// TITULO
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(80);
$pdf->SetFont('Arial','B',13);
$pdf->SetX(80);
$pdf->cell(80,7,'HISTORIAL MEDICO',0,1,'C',1);



$pdf->SetFillColor(255,255,255);
$pdf->cell(70,7,'',0,1,'C',1);


// TITULO
$pdf->SetFillColor(133,193,233);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(80);
$pdf->SetFont('Arial','B',13);
$pdf->SetX(80);
$pdf->cell(70,7,'CONSULTAS',1,1,'C',1);

// color a las celdas
$pdf->SetFillColor(133,193,233);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(10);


// encabezados

// $pdf->SetY(155);
// $pdf->cell(50,6,'DESCRIPCION',1,1,'L',1);


// $pdf->SetY(170);
$pdf->SetFont('Arial','B',10);
while($row_filtro= $resultado_filtro->fetch_assoc()){
  
    $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-CONSULTA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['id_consulta'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'PESO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['peso'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'TEMPERATURA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['temperatura'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'PRESION: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['presion_arterial'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'MOTIVO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['motivo'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['fecha'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_filtro['hora'],0,1,'L',1); 
   
    
    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(133,193,233);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
}

$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'PRUEBAS DE LABORATORIO',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_prueba= $resultado_prueba->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-PRUEBA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_prueba['id_prueba'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'NOMBRE: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_prueba['nombre_prueba'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'RESULTADO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_prueba['resultado'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_prueba['fecha'],0,1,'L',1);
    $pdf->SetX(20);
    $pdf->Cell(50,10,'PRECIO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_prueba['precio'],0,1,'L',1); 



    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}
$pdf->SetTextColor(0, 0, 0);





// ===================== empezando con recetas


$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'RECETAS',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_receta= $resultado_receta->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-RECETA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_receta['id_receta'],0,1,'L',1); 

    $pdf->SetX(20);
    $pdf->Cell(50,10,'CONSULTA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_receta['id_consulta'],0,1,'L',1);

    $pdf->SetX(20);
    $pdf->Cell(50,10,'RECETA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_receta['descripcion_receta'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_receta['fecha'],0,1,'L',1); 
    

    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}

// ===================== empezando con INGRESOS


$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'INGRESOS',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_ingreso= $resultado_ingreso->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-INGRESO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_ingreso'],0,1,'L',1); 

    $pdf->SetX(20);
    $pdf->Cell(50,10,'CONSULTA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_consulta'],0,1,'L',1);

    $pdf->SetX(20);
    $pdf->Cell(50,10,'CAMA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['numero_cama'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'SALA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_sala'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['hora'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['fecha'],0,1,'L',1); 
    

    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}


// ===================== empezando con INGRESOS


$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'ALTAS',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_alta= $resultado_alta->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-ALTA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_alta['id_alta'],0,1,'L',1); 

    $pdf->SetX(20);
    $pdf->Cell(50,10,'INGRESO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_alta['id_ingreso'],0,1,'L',1);
    $pdf->SetX(20);
    $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_alta['hora'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_alta['fecha'],0,1,'L',1); 
    

    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}




// ===================== empezando con INGRESOS


$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'INGRESOS',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_ingreso= $resultado_ingreso->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-INGRESO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_ingreso'],0,1,'L',1); 

    $pdf->SetX(20);
    $pdf->Cell(50,10,'CONSULTA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_consulta'],0,1,'L',1);

    $pdf->SetX(20);
    $pdf->Cell(50,10,'CAMA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['numero_cama'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'SALA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['id_sala'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['hora'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_ingreso['fecha'],0,1,'L',1); 
    

    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}


// ===================== empezando con CITAS MEDICAS


$pdf->Ln(10);

// $pdf->SetY(155);
 $pdf->SetX(80);
 $pdf->SetTextColor(0, 0, 0);
$pdf->cell(70,7,'CITAS MEDICAS',1,1,'C',1);
$pdf->SetFont('Arial','B',10);
// $pdf->SetY(170);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(5);

while($row_citas= $resultado_citas->fetch_assoc()){


        $pdf->SetTextColor(0, 0,0);
        $pdf->SetX(20);
    // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

    $pdf->Cell(50,10,'ID-CITA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_citas['id_cita'],0,1,'L',1); 

    $pdf->SetX(20);
    $pdf->Cell(50,10,'PACIENTE: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_citas['dip'],0,1,'L',1);
    $pdf->SetX(20);
    $pdf->Cell(50,10,'MOTIVO: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_citas['motivo'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_citas['fecha'],0,1,'L',1); 
    $pdf->SetX(20);
    $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
    $pdf->MultiCell(100,10,$row_citas['hora'],0,1,'L',1); 
    

    $pdf->SetX(20);
    $pdf->Ln(2);

    // LINEA SEPARADORA
$pdf->SetFillColor(0,0,0);
$pdf->SetX(20);
$pdf->cell(150,.2,'',1,1,'L',1);
$pdf->SetFillColor(133,193,233);
$pdf->Ln(3);
      

    
   
}





$pdf->SetTextColor(0, 0, 0);



$pdf->SetTextColor(0, 0, 0);





$pdf->Output();






?>