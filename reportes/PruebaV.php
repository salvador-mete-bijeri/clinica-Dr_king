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

      $dir ="../img/logo/";
      

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image( '../img/logo.jpg', 140, 15, 40); //logo de la empresa,

        /* TELEFONO */
        $this->SetY(35); // Posición: a 1,5 cm del final
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 3, utf8_decode("ministerio de sanidad "), 0, 1, 'C', 0);
        $this->Cell(58, 5, utf8_decode("y bienestar social "), 0, 1, 'C', 0);




      $this->Image('logo_guinea.jpg', 30, 15, 20); //logo de la empresa,
      $this->SetFont('Arial', 'B', 15); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      //CREAMOS UNA CELDA EN BLANCO
      //  $this->cell(5,30,'',0,1,'C');

      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(120, 15, utf8_decode($fila['nombre']), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(0,0,0); //color

      //CREAMOS UNA CELDA EN BLANCO
      $this->cell(100,10,'',0,1,'C');

      /* UBICACION */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode('Ubicacion: ' .$fila['direccion']), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono :" .$fila['telefono']), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo :" .$fila['email']), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Horario :" .$fila['horario']), 0, 0, '', 0);
      $this->Ln(10);

     

     
   }








   // Pie de página
   function Footer()
   {
      
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->SetFillColor(133,193,233); //color
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

