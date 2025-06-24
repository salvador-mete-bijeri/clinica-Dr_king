<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {


      require '../conexion/conexion.php';

      $sql= "SELECT * FROM hospital";
      $resultado= mysqli_query($conn,$sql);
      $fila=mysqli_fetch_assoc($resultado);

      $dir ="../ENFERMERA/logo/";
     
      $this->Image( $dir . $fila['id_hospital'] . '.jpg', 240, 15, 40); //logo de la empresa,

        /* TELEFONO */
        $this->SetY(35); // Posición: a 1,5 cm del final
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 3, utf8_decode("ministerio de sanidad "), 0, 1, 'C', 0);
        $this->Cell(58, 5, utf8_decode("y bienestar social "), 0, 1, 'C', 0);
       






        $this->SetY(15);
      $this->Image('logo_guinea.jpg', 30, 15, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG

      
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(100, 15, utf8_decode($fila['nombre']), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color


      
   }















   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}






