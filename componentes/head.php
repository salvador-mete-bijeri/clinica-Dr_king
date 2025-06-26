<?php
// iniciando la sesion

session_start();
if (!isset($_SESSION['usuario'])) {

  header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    DR-KING
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->

  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

  <!--ESTILOS DE LA TABLA -->
  <!-- css datables nuevo -->
 
<link rel="stylesheet" href="../assets//css/bootstrap.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <script src="../assets/js/ckeditor.js"></script>
  <script src="../assets/js/jquery.js"></script>


  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<?php
require '../conexion/conexion.php';
$sql_consultas1 = "SELECT * FROM consultas WHERE MONTH(fecha) = 1";
$resultado_consulta1 = mysqli_query($conn, $sql_consultas1);
$numero_consulta1=mysqli_num_rows($resultado_consulta1);

$sql_consultas2 = "SELECT * FROM consultas WHERE MONTH(fecha) = 2";
$resultado_consulta2 = mysqli_query($conn, $sql_consultas2);
$numero_consulta2=mysqli_num_rows($resultado_consulta2);

$sql_consultas3 = "SELECT * FROM consultas WHERE MONTH(fecha) = 3";
$resultado_consulta3 = mysqli_query($conn, $sql_consultas3);
$numero_consulta3=mysqli_num_rows($resultado_consulta3);


$sql_consultas4 = "SELECT * FROM consultas WHERE MONTH(fecha) = 4";
$resultado_consulta4 = mysqli_query($conn, $sql_consultas4);
$numero_consulta4=mysqli_num_rows($resultado_consulta4);

$sql_consultas5 = "SELECT * FROM consultas WHERE MONTH(fecha) = 5";
$resultado_consulta5 = mysqli_query($conn, $sql_consultas5);
$numero_consulta5=mysqli_num_rows($resultado_consulta5);

$sql_consultas6 = "SELECT * FROM consultas WHERE MONTH(fecha) = 6";
$resultado_consulta6 = mysqli_query($conn, $sql_consultas6);
$numero_consulta6=mysqli_num_rows($resultado_consulta6);

$sql_consultas7 = "SELECT * FROM consultas WHERE MONTH(fecha) = 7";
$resultado_consulta7 = mysqli_query($conn, $sql_consultas7);
$numero_consulta7=mysqli_num_rows($resultado_consulta7);

$sql_consultas8 = "SELECT * FROM consultas WHERE MONTH(fecha) = 8";
$resultado_consulta8 = mysqli_query($conn, $sql_consultas8);
$numero_consulta8=mysqli_num_rows($resultado_consulta8);


$sql_consultas9 = "SELECT * FROM consultas WHERE MONTH(fecha) = 9";
$resultado_consulta9 = mysqli_query($conn, $sql_consultas9);
$numero_consulta9=mysqli_num_rows($resultado_consulta9);


$sql_consultas10 = "SELECT * FROM consultas WHERE MONTH(fecha) = 10";
$resultado_consulta10 = mysqli_query($conn, $sql_consultas10);
$numero_consulta10=mysqli_num_rows($resultado_consulta10);

$sql_consultas11 = "SELECT * FROM consultas WHERE MONTH(fecha) = 11";
$resultado_consulta11 = mysqli_query($conn, $sql_consultas11);
$numero_consulta11=mysqli_num_rows($resultado_consulta11);


$sql_consultas12 = "SELECT * FROM consultas WHERE MONTH(fecha) = 12";
$resultado_consulta12 = mysqli_query($conn, $sql_consultas12);
$numero_consulta12=mysqli_num_rows($resultado_consulta12);



$sql_pacientesm = "SELECT * FROM pacientes  WHERE sexo='M'";
$resultado_pacientesm = mysqli_query($conn, $sql_pacientesm);
$numero_pacientesm=mysqli_num_rows($resultado_pacientesm);

$sql_pacientesf = "SELECT * FROM pacientes  WHERE sexo='F'";
$resultado_pacientesf = mysqli_query($conn, $sql_pacientesf);
$numero_pacientesf=mysqli_num_rows($resultado_pacientesf);

?>



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Meses', 'Consultas'],
          ['ENERO',  <?= $numero_consulta1 ?>   ],
          ['FEBRERO',  <?= $numero_consulta2?>   ],
          ['MARZO',  <?= $numero_consulta3 ?>   ],
          ['ABRIL',  <?= $numero_consulta4 ?>   ],
          ['MAYO',  <?= $numero_consulta5 ?>   ],
          ['JUNIO',  <?= $numero_consulta6 ?>    ],
          ['JULIO',  <?= $numero_consulta7 ?>   ],
          ['AGOSTO',  <?= $numero_consulta8 ?>   ],
          ['SEPTIEMBRE',  <?= $numero_consulta9 ?>   ],
          ['OCTUBRE',  <?= $numero_consulta10 ?>    ],
          ['NOVIEMBRE',  <?= $numero_consulta11 ?>    ],
          ['DICIEMBRE',  <?= $numero_consulta12 ?>   ]
        ]);

        var options = {
          title : 'Consulta por meses...',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Meses'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>





<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'], 
          ['Masculino',  <?= $numero_pacientesm ?>],
          ['Femenino',  <?= $numero_pacientesf ?>],
        
        ]);

        var options = {
          title: 'PACIENTES'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>





  <style>
    .hidden {
      display: none;
    }
  </style>

<style>
.modal-content {
  border-radius: 12px;
}

.card {
  border-radius: 10px;
  background-color: #ffffff;
}

.modal-body {
  font-size: 15px;
}

.card-title {
  font-weight: 600;
  font-size: 16px;
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 8px;
}
</style>



<style>
  .modal-backdrop.show {
    z-index: 9998 !important;
  }

  .modal.show {
    z-index: 9999 !important;
  }

  .modal-dialog {
    z-index: 10000 !important;
  }
</style>

</head>

