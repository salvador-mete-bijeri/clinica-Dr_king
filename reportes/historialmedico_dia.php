<?php

include 'PruebaV_corto.php';

require '../conexion/conexion.php';

// obteniedo la hora y la fecha actual


date_default_timezone_set('America/Mexico_City');

$fecha_actual = getdate();



$fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];


/////////=========



// $dip_filtro=$_POST['dip'];
// $fecha_filtro=$_POST['fecha'];


$codigo_filtro = $_POST['codigo'];
$fecha_filtro = $_POST['fecha'];






$sql_consulta = "SELECT * FROM consultas where paciente_cod='$codigo_filtro' and fecha='$fecha_filtro'";
$resultado_filtro = mysqli_query($conn, $sql_consulta);
$fila_consulta= mysqli_fetch_assoc($resultado_filtro);
$numero_consulta=mysqli_num_rows($resultado_filtro);


if ($numero_consulta <1)
{
    header('Location: ../DOCTOR/pruebas.php?mensaje=codigo'); 
}




$sql_detalle_consulta = "SELECT * FROM detalles_consultas where codigo_pac='$codigo_filtro' and fecha='$fecha_filtro'";
$resultado_filtro_detalle = mysqli_query($conn, $sql_detalle_consulta);
$fila_detalle = mysqli_fetch_assoc($resultado_filtro_detalle);

// $sql_filtro1="SELECT * FROM receta where dip=$dip_filtro and fecha='${fecha_filtro}'";
// $resultado_filtro1=mysqli_query($conn,$sql_filtro1);

$sql_prueba = "SELECT `prueba`.`codigo_pac`,`prueba`.`fecha`,`prueba`.`resultado`, `tipo_prueba`.`nombre_prueba`FROM `prueba` LEFT JOIN `tipo_prueba` ON `prueba`.`id_tipo_prueba` = `tipo_prueba`.`id` WHERE codigo_pac='$codigo_filtro' AND fecha='$fecha_filtro'";
$resultado_prueba = mysqli_query($conn, $sql_prueba);




$sql_receta = "SELECT * FROM receta where codigo_pac='$codigo_filtro' and fecha='$fecha_filtro'";
$resultado_receta = mysqli_query($conn, $sql_receta);




$sql_citas = "SELECT * FROM citas where codigo='$codigo_filtro' and fecha>='$fecha_filtro'";
$resultado_citas = mysqli_query($conn, $sql_citas);





$sql_receta2 = "SELECT * FROM receta where codigo_pac='$codigo_filtro' and fecha='$fecha_filtro'";
$resultado_receta2 = mysqli_query($conn, $sql_receta2);

// $sql_citas="SELECT * FROM citas where  dip=$dip_filtro and fecha='$fecha_filtro' ";
// $resultado_citas=mysqli_query($conn,$sql_citas);



////////////////////------------------------////////
$sql2 = "SELECT * FROM pacientes where codigo='$codigo_filtro' limit 1";
$resultado2 = mysqli_query($conn, $sql2);
$fila2 = mysqli_fetch_assoc($resultado2);

$filas = $resultado2->num_rows;

if ($filas < 1) {
    header('Location: ../ADMINISTRADOR/index.php?mensaje=nada');
}




$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();





// color a las celdas
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(25, 6, 'PACIENTE: ', 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->cell(30, 6, $fila2['nombre'], 0, 0, 'L', 1);
$pdf->cell(45, 6, $fila2['apellidos'], 0, 1, 'L', 1);
$pdf->Ln(2);



$pdf->SetFont('Arial', '', 10);
// encabezados



$pdf->SetX(20);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(25, 6, 'Domicilio:', 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45, 6, $fila2['direccion'], 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(25, 6, 'F. Nacimiento:', 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45, 6, $fila2['fecha_nacimiento'], 0, 1, 'L', 1);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(25, 6, 'Telefono:', 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45, 6, $fila2['tel'], 0, 1, 'L', 1);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(25, 6, 'Informante:', 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45, 6, $fila2['tutor'], 0, 1, 'L', 1);



// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(70, .05, '', 1, 1, 'L', 1);



$pdf->SetFillColor(255, 255, 255);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->cell(25, 6, 'MC:', 0, 0, 'L', 1);
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(45, 6, $fila_consulta['motivo'], 0, 1, 'L', 1);
$pdf->Ln(2);
$pdf->SetX(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->cell(10, 6, 'HEA:', 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->SetX(20);
$pdf->MultiCell(175, 5, $fila_consulta['hea'], 1, 1, 'L', 1);





 $pdf->Ln(1);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);


// $fila_detalle


$pdf->SetFillColor(255, 255, 255);
$pdf->SetX(20);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(50, 5, 'Antecedentes Patologicos Relev :', 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$antecedentes = $fila_detalle['antecedentes_patologicos'];
if ($antecedentes == "") {

    $pdf->cell(30, 5, 'NO', 0, 0, 'L', 1);
} else {

    $pdf->cell(45, 5, 'SI', 0, 0, 'L', 1);
}


$pdf->SetX(110);
$pdf->cell(45, 6, 'Visita Medica Ult 14 dias :', 0, 0, 'L', 1);
$visita_medica = $fila_detalle['visita_medica'];
if ($visita_medica == "SI") {

    $pdf->cell(30, 5, 'SI', 0, 1, 'L', 1);
} else {

    $pdf->cell(45, 5, 'NO', 0, 1, 'L', 1);
}





$pdf->SetX(20);
$pdf->cell(50, 5, 'Tratamiento :', 0, 0, 'L', 1);
$pdf->cell(45, 5, $fila_detalle['antecedentes_patologicos'], 0, 0, 'L', 1);

$pdf->SetX(20);
$pdf->cell(50, 5, 'Antecedente :', 0, 0, 'L', 1);
$pdf->cell(45, 5, $fila_detalle['antecedente'], 0, 0, 'L', 1);



$pdf->SetX(110);
 $pdf->cell(30, 5, 'Diagnostico: ', 0, 0, 'L', 1);
 $pdf->cell(50, 5, $fila_detalle['diagnostico'], 0, 1, 'L', 1);



$pdf->SetX(20);
$pdf->cell(50, 5, 'Grupo Sanguineo :', 0, 0, 'L', 1);
$pdf->cell(30, 5, $fila_detalle['grupo_sanguineo'], 0, 0, 'L', 1);

// // tratamiento de la visita medica despues de los 14 dias
$pdf->SetX(110);

$pdf->cell(30, 5, 'Tratamiento Previo: ', 0, 0, 'L', 1);
$pdf->cell(50, 5, $fila_detalle['tratamiento'], 0, 1, 'L', 1);



$pdf->SetX(20);
$pdf->cell(50, 6, 'Alergia Medicamentosa :', 0, 0, 'L', 1);
$alergia_med = $fila_detalle['alergia_medi'];

if ($alergia_med == "NO") {

    $pdf->cell(30, 6, 'NO', 0, 1, 'L', 1);
} else {

    $pdf->cell(45, 6, $fila_detalle['alergia_medi'], 0, 1, 'L', 1);
}





// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(3);



$pdf->SetX(20);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 10);
$pdf->cell(30, 5, 'Exploracion Medica: ', 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(10, 5, 'Peso :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['peso'], 0, 0, 'L', 1);



$pdf->SetX(90);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(10, 5, 'TA :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['tension_arterial'], 0, 0, 'L', 1);

$pdf->SetX(150);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(25, 5, 'Temperatura :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['temperatura'], 0, 1, 'L', 1);


$pdf->SetX(20);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(10, 5, 'Altura :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['altura'], 0, 0, 'L', 1);


$pdf->SetX(90);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(10, 5, 'Pulso :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['pulso'], 0, 0, 'L', 1);

$pdf->SetX(150);
$pdf->SetFont('Arial', '', 9);
$pdf->cell(25, 5, 'PO2 :', 0, 0, 'L', 1);
$pdf->cell(40, 5, $fila_consulta['PO2'], 0, 1, 'L', 1);


$pdf->Ln(1);

$pdf->SetX(20);
$pdf->MultiCell(175, 4, $fila_consulta['observaciones'], 1, 1, 'L', 1);



 $pdf->Ln(1);
// // LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->MultiCell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);



$pdf->SetX(20);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 10);
$pdf->cell(30, 5, 'Complementarios: ', 0, 1, 'L', 1);



while ($row_prueba = $resultado_prueba->fetch_assoc()) {

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetX(20);
    $pdf->Cell(40, 5, $row_prueba['nombre_prueba'], 0, 0, 'L', 1);

    $resultado = $row_prueba['resultado'];
    if ($resultado == "") {
        $pdf->SetX(80);
        $pdf->Cell(100, 5, 'en espera', 0, 1, 'L', 1);
    } else {
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(100, 5, $row_prueba['resultado'], 0, 1, 'L', 1);
        $pdf->SetTextColor(0, 0, 0);
    }
}

$pdf->Ln(1);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);




while ($row_receta = $resultado_receta->fetch_assoc()) {

    $pdf->SetFont('Arial', 'B', 9);

    $pdf->SetX(140);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(5, 5, 'Id: ', 0, 0, 'L', 1);
    $pdf->Cell(40, 5, $row_receta['id_diagnostico'], 1, 1, 'L', 1);
    $pdf->Ln(3);


    $pdf->SetFont('Arial', '', 9);
    $pdf->SetX(20);
    $pdf->MultiCell(175, 5, $row_receta['descripcion_receta'], 1, 0, 'L', 1);
}

$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);





while ($row_receta2 = $resultado_receta2->fetch_assoc()) {

    $pdf->SetX(20);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->cell(30, 6, 'Comentario: ', 0, 0, 'L', 1);
    $pdf->MultiCell(80, 6, $row_receta2['comentario'], 0, 1, 'L', 1);


   
}

$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);


while ($row_citas = $resultado_citas->fetch_assoc()) {

    $pdf->SetX(20);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->cell(30, 6, 'Revision Medica: ', 0, 0, 'L', 1);
    $pdf->MultiCell(80, 6, $row_citas['fecha'], 0, 1, 'L', 1);


   
}



$pdf->Ln(2);

// LINEA SEPARADORA
$pdf->SetFillColor(0, 0, 0);
$pdf->SetX(20);
$pdf->cell(175, .05, '', 1, 1, 'L', 1);
$pdf->Ln(1);

$pdf->SetX(40);
$pdf->SetFont('Arial', '', 9);
$pdf->SetFillColor(255, 255, 255);
$pdf->cell(30, 6, 'Telefono y Whatsaap Medico/ 555-549006 222-233502: ', 0, 0, 'L', 1);

$pdf->SetX(150);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(255, 255, 255);
$pdf->cell(30, 6, '/   Medico: Dr. King ', 0, 0, 'L', 1);




























// $pdf->SetTextColor(0, 0, 0);



// // TITULO
// $pdf->SetFillColor(232,232,232);
// $pdf->SetTextColor(0, 0, 255);
// $pdf->SetX(80);
// $pdf->SetFont('Arial','B',13);
// $pdf->SetX(80);
// $pdf->cell(70,7,'CONSULTAS',1,1,'C',1);

// // color a las celdas
// $pdf->SetFillColor(250,250,250);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(10);


// // encabezados

// // $pdf->SetY(155);
// // $pdf->cell(50,6,'DESCRIPCION',1,1,'L',1);


// // $pdf->SetY(170);
// $pdf->SetFont('Arial','B',10);
// while($row_filtro= $resultado_filtro->fetch_assoc()){

//     $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-CONSULTA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['id_consulta'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'PESO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['peso'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'TEMPERATURA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['temperatura'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'PRESION: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['presion_arterial'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'MOTIVO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['motivo'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['fecha'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_filtro['hora'],0,1,'L',1); 


//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);
// }

// $pdf->Ln(10);

// // $pdf->SetY(155);
//  $pdf->SetX(80);
//  $pdf->SetTextColor(0, 0, 255);
// $pdf->cell(70,7,'PRUEBAS DE LABORATORIO',1,1,'C',1);
// $pdf->SetFont('Arial','B',10);
// // $pdf->SetY(170);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(5);

// while($row_prueba= $resultado_prueba->fetch_assoc()){


//         $pdf->SetTextColor(0, 0,0);
//         $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-PRUEBA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_prueba['id_prueba'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'NOMBRE: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_prueba['nombre_prueba'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'RESULTADO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_prueba['resultado'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_prueba['fecha'],0,1,'L',1);
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'PRECIO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_prueba['precio'],0,1,'L',1); 



//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);




// }
// $pdf->SetTextColor(0, 0, 0);





// // ===================== empezando con recetas


// $pdf->Ln(10);

// // $pdf->SetY(155);
//  $pdf->SetX(80);
//  $pdf->SetTextColor(0, 0, 255);
// $pdf->cell(70,7,'RECETAS',1,1,'C',1);
// $pdf->SetFont('Arial','B',10);
// // $pdf->SetY(170);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(5);

// while($row_receta= $resultado_receta->fetch_assoc()){


//         $pdf->SetTextColor(0, 0,0);
//         $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-RECETA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_receta['id_receta'],0,1,'L',1); 

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'CONSULTA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_receta['id_consulta'],0,1,'L',1);

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'RECETA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_receta['descripcion_receta'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_receta['fecha'],0,1,'L',1); 


//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);




// }

// // ===================== empezando con INGRESOS


// $pdf->Ln(10);

// // $pdf->SetY(155);
//  $pdf->SetX(80);
//  $pdf->SetTextColor(0, 0, 255);
// $pdf->cell(70,7,'INGRESOS',1,1,'C',1);
// $pdf->SetFont('Arial','B',10);
// // $pdf->SetY(170);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(5);

// while($row_ingreso= $resultado_ingreso->fetch_assoc()){


//         $pdf->SetTextColor(0, 0,0);
//         $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-INGRESO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['id_ingreso'],0,1,'L',1); 

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'CONSULTA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['id_consulta'],0,1,'L',1);

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'CAMA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['numero_cama'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'SALA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['id_sala'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['hora'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_ingreso['fecha'],0,1,'L',1); 


//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);




// }


// // ===================== empezando con INGRESOS


// $pdf->Ln(10);

// // $pdf->SetY(155);
//  $pdf->SetX(80);
//  $pdf->SetTextColor(0, 0, 255);
// $pdf->cell(70,7,'ALTAS',1,1,'C',1);
// $pdf->SetFont('Arial','B',10);
// // $pdf->SetY(170);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(5);

// while($row_alta= $resultado_alta->fetch_assoc()){


//         $pdf->SetTextColor(0, 0,0);
//         $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-ALTA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_alta['id_alta'],0,1,'L',1); 

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'INGRESO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_alta['id_ingreso'],0,1,'L',1);
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_alta['hora'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_alta['fecha'],0,1,'L',1); 


//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);




// }

// // ===================== empezando con CITAS MEDICAS


// $pdf->Ln(10);

// // $pdf->SetY(155);
//  $pdf->SetX(80);
//  $pdf->SetTextColor(0, 0, 255);
// $pdf->cell(70,7,'CITAS MEDICAS',1,1,'C',1);
// $pdf->SetFont('Arial','B',10);
// // $pdf->SetY(170);
// $pdf->SetTextColor(0, 0, 0);

// $pdf->Ln(5);

// while($row_citas= $resultado_citas->fetch_assoc()){


//         $pdf->SetTextColor(0, 0,0);
//         $pdf->SetX(20);
//     // $pdf->cell(100,50,$row_filtro['descripcion_receta'],1,1,'L',1);

//     $pdf->Cell(50,10,'ID-CITA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_citas['id_cita'],0,1,'L',1); 

//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'PACIENTE: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_citas['dip'],0,1,'L',1);
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'MOTIVO: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_citas['motivo'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'FECHA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_citas['fecha'],0,1,'L',1); 
//     $pdf->SetX(20);
//     $pdf->Cell(50,10,'HORA: ',0,0,'L',1);
//     $pdf->MultiCell(100,10,$row_citas['hora'],0,1,'L',1); 


//     $pdf->SetX(20);
//     $pdf->Ln(2);

//     // LINEA SEPARADORA
// $pdf->SetFillColor(0,0,0);
// $pdf->SetX(20);
// $pdf->cell(150,.2,'',1,1,'L',1);
// $pdf->SetFillColor(255,255,255);
// $pdf->Ln(3);




// }
// $pdf->SetTextColor(0, 0, 0);



// $pdf->SetTextColor(0, 0, 0);





$pdf->Output();
