<?php
// menu

include '../componentes/head.php';
?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <?php
  // menu
  include '../componentes/menu-admin.php';
  ?>

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tables</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Tables</h6>
        </nav>



      </div>
    </nav>






    <div class="container mt-4">

  <!-- FILTROS -->
  <div class="card shadow mb-4 p-3">
    <div class="row">
      <div class="col-md-6 mb-2">
        <label for="filtro_fecha" class="form-label fw-bold">Filtrar por Fecha</label>
        <input type="date" id="filtro_fecha" class="form-control" />
      </div>
      <div class="col-md-6 mb-2">
         <label for="mesFiltro">Selecciona un mes:</label>
        <input type="month" id="filtro_mes" class="form-control">
      </div>
    </div>
  </div>

  <!-- HISTORIAL -->
  <div class="row">
    <!-- CONSULTAS -->
    <div class="col-md-6">
      <div class="card shadow p-3 mb-4">
        <h5 class="text-center text-primary fw-bold">Historial de Consultas</h5>
        <div id="resultado_consultas"></div>
        <hr />
        <p class="fw-bold text-center">Total: <span id="total_consultas">0</span> FCFA</p>
        <canvas id="graficaConsultas" height="100"></canvas>
         <div id="infoConsultas" class="text-center mt-2 fw-bold text-primary"></div>
      </div>
    </div>

    <!-- PRUEBAS -->
    <div class="col-md-6">
      <div class="card shadow p-3 mb-4">
        <h5 class="text-center text-success fw-bold">Historial de Pruebas Médicas</h5>
        <div id="resultado_pruebas"></div>
        <hr />
        <p class="fw-bold text-center">Total: <span id="total_pruebas">0</span> FCFA</p>
        <canvas id="graficaPruebas" height="100"></canvas>
         <div id="infoPruebas" class="text-center mt-2 fw-bold text-warning"></div>
      </div>
    </div>
  </div>
</div>






<script>
document.addEventListener("DOMContentLoaded", function () {
  const fechaInput = document.getElementById("filtro_fecha");
  const mesInput = document.getElementById("filtro_mes");

  fechaInput.addEventListener("change", filtrarPorFecha);
  mesInput.addEventListener("change", filtrarPorMes);

  function filtrarPorFecha() {
    const fecha = fechaInput.value;
    mesInput.value = ''; // Reinicia el filtro de mes al aplicar filtro de fecha

    if (!fecha) {
      reiniciarTodo();
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax_filtro_fecha.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      try {
        const data = JSON.parse(this.responseText);
        if (data.error) return alert(data.error);

        actualizarResultados(data);
      } catch (e) {
        console.error("Error JSON:", e, this.responseText);
        alert("Ocurrió un error inesperado.");
      }
    };

    xhr.send("fecha=" + encodeURIComponent(fecha));
  }

  function filtrarPorMes() {
    const mes = mesInput.value;
    fechaInput.value = ''; // Reinicia el filtro de fecha al aplicar filtro de mes

    if (!mes) {
      reiniciarTodo();
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax_filtro_mes.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      try {
        const data = JSON.parse(this.responseText);
        if (data.error) return alert(data.error);

        actualizarResultados(data);
      } catch (e) {
        console.error("Error JSON:", e, this.responseText);
        alert("Ocurrió un error inesperado.");
      }
    };

    xhr.send("mes=" + encodeURIComponent(mes));
  }

  function actualizarResultados(data) {
    document.getElementById("resultado_consultas").innerHTML = data.consultas_html;
    document.getElementById("total_consultas").textContent = data.consultas_total;

    document.getElementById("resultado_pruebas").innerHTML = data.pruebas_html;
    document.getElementById("total_pruebas").textContent = data.pruebas_total;

    mostrarGraficas(data.consultas_total, data.pruebas_total);
  }

  function reiniciarTodo() {
    document.getElementById("resultado_consultas").innerHTML = '<p class="text-muted text-center">No hay consultas.</p>';
    document.getElementById("resultado_pruebas").innerHTML = '<p class="text-muted text-center">No hay pruebas.</p>';
    document.getElementById("total_consultas").textContent = '0';
    document.getElementById("total_pruebas").textContent = '0';
    reiniciarGraficas();
  }
});

let chartConsultas = null;
let chartPruebas = null;

function reiniciarGraficas() {
  if (chartConsultas) chartConsultas.destroy();
  if (chartPruebas) chartPruebas.destroy();

  const ctxConsultas = document.getElementById('graficaConsultas').getContext('2d');
  chartConsultas = new Chart(ctxConsultas, {
    type: 'bar',
    data: {
      labels: ['Consultas'],
      datasets: [{
        label: 'Sin datos',
        data: [0],
        backgroundColor: 'rgba(200, 200, 200, 0.5)',
        borderRadius: 10
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        x: {
          max: 100,
          ticks: { callback: value => value + '%' }
        }
      },
      plugins: { legend: { display: false } }
    }
  });

  const ctxPruebas = document.getElementById('graficaPruebas').getContext('2d');
  chartPruebas = new Chart(ctxPruebas, {
    type: 'bar',
    data: {
      labels: ['Pruebas Médicas'],
      datasets: [{
        label: 'Sin datos',
        data: [0],
        backgroundColor: 'rgba(200, 200, 200, 0.5)',
        borderRadius: 10
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        x: {
          max: 100,
          ticks: { callback: value => value + '%' }
        }
      },
      plugins: { legend: { display: false } }
    }
  });
}

function mostrarGraficas(totalConsultas, totalPruebas) {
  const metaConsultas = 300000;
  const metaPruebas = 700000;

  const porcentajeConsultas = Math.min((totalConsultas / metaConsultas) * 100, 100).toFixed(1);
  const porcentajePruebas = Math.min((totalPruebas / metaPruebas) * 100, 100).toFixed(1);

  if (chartConsultas) chartConsultas.destroy();
  if (chartPruebas) chartPruebas.destroy();

  const ctxConsultas = document.getElementById('graficaConsultas').getContext('2d');
  chartConsultas = new Chart(ctxConsultas, {
    type: 'bar',
    data: {
      labels: ['Consultas'],
      datasets: [{
        label: `${porcentajeConsultas}% del objetivo (300.000 FCFA)`,
        data: [porcentajeConsultas],
        backgroundColor: 'rgba(13, 110, 253, 0.7)',
        borderRadius: 10
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        x: {
          max: 100,
          ticks: { callback: value => value + '%' }
        }
      },
      plugins: { legend: { display: false } }
    }
  });

  const ctxPruebas = document.getElementById('graficaPruebas').getContext('2d');
  chartPruebas = new Chart(ctxPruebas, {
    type: 'bar',
    data: {
      labels: ['Pruebas Médicas'],
      datasets: [{
        label: `${porcentajePruebas}% del objetivo (700.000 FCFA)`,
        data: [porcentajePruebas],
        backgroundColor: 'rgba(25, 135, 84, 0.7)',
        borderRadius: 10
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        x: {
          max: 100,
          ticks: { callback: value => value + '%' }
        }
      },
      plugins: { legend: { display: false } }
    }
  });
}
</script>






























    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-primary text-white rounded-top-4">
            <h5 class="modal-title" id="confirmLogoutLabel">
              <i class="fa fa-sign-out-alt me-2"></i> ¿Cerrar sesión?
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body text-center py-4">
            <i class="fa fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            <p class="fs-5 mb-0">¿Estás seguro de que deseas cerrar sesión?</p>
          </div>
          <div class="modal-footer justify-content-center border-0 pb-4">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
              Cancelar
            </button>
            <a href="../cerrar_sesion.php" class="btn btn-danger px-4">
              Sí, cerrar sesión
            </a>
          </div>
        </div>
      </div>
    </div>



    <?php
    // menu
    include '../componentes/footer.php';
    ?>