<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Prueba Consultas</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>

<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>CÓDIGO</th>
      <th>PESO</th>
      <th>ALTURA</th>
      <th>TENSIÓN</th>
      <th>PULSO</th>
      <th>TEMP</th>
      <th>PO2</th>
      <th>FECHA</th>
      <th>HORA</th>
      <th>PRECIO</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ajax: {
        url: 'datos_consultas.php',
        type: 'GET'
      },
      columns: [
        { data: 'paciente_cod' },
        { data: 'peso' },
        { data: 'altura' },
        { data: 'tension_arterial' },
        { data: 'pulso' },
        { data: 'temperatura' },
        { data: 'PO2' },
        { data: 'fecha' },
        { data: 'hora' },
        { data: 'precio' },
        {
          data: null,
          render: function (data) {
            return `
              <a href="editar.php?id=${data.id}" class="btn btn-sm btn-primary">Editar</a>
            `;
          }
        }
      ],
      language: {
        emptyTable: "Use el buscador para encontrar un código"
      }
    });
  });
</script>
</body>
</html>
