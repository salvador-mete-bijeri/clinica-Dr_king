<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      require '../conexion/conexion.php';

      $sql= "SELECT * FROM clinica";
      $resultado= mysqli_query($conn,$sql);
      $fila=mysqli_fetch_assoc($resultado);


      

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
       


       $this->SetY(20);
       $this->SetX(117); // Posición: a 1,5 cm del final
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', '', 8);
      
        $this->SetTextColor(60,179,113);
       $this->Cell(58, 5, utf8_decode(" 'Porque tu vida importa, Cambiamos y crecemos contigo' "), 0, 1, 'C', 0);


       $this->Ln(2);

       // LINEA SEPARADORA
       $this->SetFillColor(0,0,0);
       $this->SetX(25);
       $this->cell(170,.05,'',1,1,'L',1);
       $this->Ln(10);







      $this->Image('../img/logo.jpg', 30, 15, 20); //logo de la empresa,
      $this->SetFont('Arial', 'B', 15); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      //CREAMOS UNA CELDA EN BLANCO
      //  $this->cell(5,30,'',0,1,'C');









     

     
   }








   // Pie de página
   function Footer()
   {
      
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->SetFillColor(133,193,233); //color
     

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
    
   }
}

