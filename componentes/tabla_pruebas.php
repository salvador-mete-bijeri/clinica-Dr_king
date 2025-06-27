 <!-- End Navbar -->
 <?php

    require '../conexion/conexion.php';


    $sqlPacientes = "SELECT 
    pacientes.nombre,
    pacientes.codigo,
    prueba.fecha,
    GROUP_CONCAT(DISTINCT tipo_prueba.nombre_prueba ORDER BY tipo_prueba.nombre_prueba SEPARATOR '<br>') AS pruebas,
    GROUP_CONCAT(DISTINCT tipo_prueba.precio ORDER BY tipo_prueba.nombre_prueba SEPARATOR '<br>') AS precios,
    MAX(prueba.id_prueba) AS id_prueba,
    
    -- Estado: 1 solo si todas las pruebas tienen estado = 1, 0 en caso contrario
    CASE 
        WHEN SUM(CASE WHEN prueba.estado = 1 THEN 1 ELSE 0 END) = COUNT(*) THEN 1
        ELSE 0
    END AS estado,

    -- Verifica si todas las pruebas están pagadas
    CASE 
        WHEN SUM(CASE WHEN prueba.pagado = 1 THEN 1 ELSE 0 END) = COUNT(*) THEN 1
        ELSE 0
    END AS pagado

FROM prueba
LEFT JOIN pacientes ON prueba.paciente = pacientes.id
LEFT JOIN tipo_prueba ON prueba.id_tipo_prueba = tipo_prueba.id
-- Eliminé el LEFT JOIN consultas para evitar duplicados innecesarios
-- Si necesitas datos de consultas, agrégalo con un JOIN específico y agrupa correctamente

GROUP BY pacientes.codigo, prueba.fecha, pacientes.nombre
ORDER BY prueba.fecha DESC";

    $pacientes = $conn->query($sqlPacientes);



    // iniciando la sesion

    // session_start();
    // if(!isset($_SESSION['usuario'])){

    //   header('Location:../login.php');
    // }


    ?>
 <div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card mb-4">
                 <div class="card-header pb-0">
                    
                 <form action="../reportes/pruebas_laboratorio.php" method="post" target="_blank">
                     <div class="row  justify-content-center">

                         <div class="col-md-2">
                          
                             <input type="text" class="form-control" name="codigo" id="codigo" value="CP-" required>
                         </div>

                         <div class="col-md-2">

                          
                             <input type="date" class="form-control" name="fecha" id="fecha" required>

                         </div>

                         <div class="col-md-2 ">

                        
                        <button type="submit" class="btn btn-warning btn-sm"> Imprimir </button>

                         </div>

                         </div>
                     </form>
                 </div>




                 <!-- alerta -->

                 <?php
                    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'insertado') {
                    ?>

                     <div class="alert alert-info alert-dismissible fade show" role="alert">
                         <i class="fas fa-info-circle"></i>
                         <strong> Hola!</strong> su registro ha tenido Exito.
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>

                 <?php } ?>
                 <?php
                    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'actualizado') {
                    ?>

                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                         <i class="fas fa-info-circle"></i>
                         <strong> Hola!</strong> su registro ha sido actualizado.
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>

                 <?php } ?>




                 <?php
                    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'igual') {
                    ?>

                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <i class="fas fa-info-circle"></i>
                         <strong> Hola!</strong> el DIP ya corresponde a un paciente.
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>

                 <?php } ?>

                 <?php
                    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'codigo') {
                    ?>

                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                         <i class="fas fa-info-circle"></i>
                         <strong> Hola!</strong> no existe ningun registreo con esta fecha y este codigo.
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>

                 <?php } ?>










                 <div class="card-body px-0 pt-0 pb-2">
                     <div class="table-responsive p-0">
                         <table id="example" class="table table-striped" style="width:100%">
                             <thead>
                                 <th>ID</th>
                                 <th>CODIGO</th>
                                 <th>NOMBRE</th>
                                 <th>PRUEBA</th>
                                 <th>TESULTADO</th>
                                 <th>FECHA</th>
                                 <th>Acciones</th>
                             </thead>
                              <tbody>
<?php while ($row_pacientes = $pacientes->fetch_assoc()) { 
    // Badges para estado y pagado
    $estado_html = ($row_pacientes['estado'] == 0)
        ? "<span class='badge bg-danger'>PENDIENTE...</span>"
        : "<span class='badge bg-success'>RESULTADOS...</span>";

    $pagado_html = ($row_pacientes['pagado'] == 0)
        ? "<span class='badge bg-danger'>PENDIENTE...</span>"
        : "<span class='badge bg-success'>PAGADA...</span>";
?>
    <tr>
        <td><?= htmlspecialchars($row_pacientes['id_prueba']); ?></td>
        <td><?= htmlspecialchars($row_pacientes['codigo']); ?></td>
        <td><?= htmlspecialchars($row_pacientes['nombre']); ?></td>
        <td style="white-space: normal;"><?= $row_pacientes['pruebas']; ?></td> <!-- Pruebas con <br> -->
        <td><?= $estado_html; ?></td>
        <td><?= htmlspecialchars($row_pacientes['fecha']); ?></td>
        <td>
            <a href="../reportes/pruebas_laboratorio_por_dia.php?codigo=<?= urlencode($row_pacientes['codigo']); ?>&fecha=<?= urlencode($row_pacientes['fecha']); ?>"
                class="btn btn-sm btn-warning"
                target="_blank"
                title="Imprimir reporte">
                <i class="fa fa-print"></i>
            </a>
        </td>
    </tr>
<?php } ?>
</tbody>
                             <tfoot>
                                 <tr>
                                     <th>ID</th>
                                     <th>CODIGO</th>
                                     <th>NOMBRE</th>
                                     <th>PRUEBA</th>
                                     <th>TESULTADO</th>
                                     <th>FECHA</th>
                                     <th>Acciones</th>
                                 </tr>
                             </tfoot>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <script>
        

         $(document).ready(function() {
  $('#example').DataTable({
    // Opciones extras (opcional)
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      paginate: {
        previous: "Anterior",
        next: "Siguiente"
      }
    }
  });
});

     </script>