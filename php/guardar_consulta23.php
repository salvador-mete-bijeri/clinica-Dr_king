<?php


require '../conexion/conexion.php';



$cod = $conn->real_escape_string($_POST['doc']);
$id = $conn->real_escape_string($_POST['id']);
$peso = $conn->real_escape_string($_POST['peso']);
$altura = $conn->real_escape_string($_POST['altura']);
$tension_arterial = $conn->real_escape_string($_POST['tension_arterial']);
$pulso = $conn->real_escape_string($_POST['pulso']);
$temperatura = $conn->real_escape_string($_POST['temperatura']);
$peo = $conn->real_escape_string($_POST['peo']);
$fecha = $conn->real_escape_string($_POST['fecha']);
$hora = $conn->real_escape_string($_POST['hora']);
$precio = $conn->real_escape_string($_POST['precio']);
$motivo = $conn->real_escape_string($_POST['motivo']);

$hea = $conn->real_escape_string($_POST['hea']);

$observacion = $conn->real_escape_string($_POST['observacion']);


  
$sql= "INSERT INTO consultas (peso,altura,tension_arterial,pulso,temperatura,PO2,paciente_id,paciente_cod,fecha,hora,precio,motivo,observaciones,hea)
VALUES ('$peso','$altura','$tension_arterial', '$pulso','$temperatura','$peo',$id, '$cod','$fecha','$hora','$precio','$motivo','$observacion','$hea')";



if($conn->query($sql)){
    $id=$conn->insert_id;

    $alergia = $conn->real_escape_string($_POST['alergia1']);

    $antecedentes1 = $conn->real_escape_string($_POST['antecedentes1']);
    $grupo_sanguineo = $conn->real_escape_string($_POST['grupo_sanguineo']);

    $antecedente = $conn->real_escape_string($_POST['antecedente']);

    

    $visita2 = $conn->real_escape_string($_POST['visita2']);
    $visita1 = $conn->real_escape_string($_POST['visita1']);
    $visita3 = $conn->real_escape_string($_POST['visita3']);
   

    if ($alergia==''){

        $alergia='NO';
    }elseif($antecedentes1==''){

        $antecedentes1='NO';

    }elseif($visita2='' and $visita2=''){

        $visita3='NO';
    }



    $sql= "INSERT INTO detalles_consultas (antecedentes_patologicos,grupo_sanguineo,alergia_medi,visita_medica, diagnostico,tratamiento,consulta_id,codigo_pac,fecha,antecedente)
    VALUES ('$antecedentes1','$grupo_sanguineo','$alergia','$visita3','$visita1','$visita2',$id,'$cod','$fecha','$antecedente')";
    
    
    
    if($conn->query($sql)){
       
      
        header('Location: ../DOCTOR/consultas.php?mensaje=insertado'); 

    }else{
        echo "error de insersion de detalle de la consulta";
    }



}else{
    echo "error de insersion de la consulta";
}

header('Location: ../ENFERMERA/consultas.php?mensaje=insertado'); 



?>