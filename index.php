
<?php


require 'conexion/conexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $usuario=mysqli_real_escape_string($conn, $_POST['usuario'] ) ;
    
    $password=mysqli_real_escape_string($conn, $_POST['password'] )  ;



    if(!$usuario){
        echo 'porfavor el usuario es necesario';
    }



    if(!$password){
        echo 'porfavor el password es obligatorio';
    }

    if($usuario!=""){
        $sql="SELECT `usuarios`.`nombre_usuario`, `usuarios`.`password_usuario`, `roles`.`nombre` FROM `usuarios` LEFT JOIN `roles` ON `usuarios`.`id_rol` = `roles`.`id_rol` where nombre_usuario='${usuario}'";
        $resultado= mysqli_query($conn,$sql);

       

     

      if($resultado->num_rows){


        // verificar si el password es corecto

        $usuario= mysqli_fetch_assoc($resultado);

        $auth= password_verify($password, $usuario['password_usuario'] );

        var_dump($auth);

        echo 'usuario verificado';

        if($auth){
            // cuando existe el usuario y la contrasena

        

        $tipo_user=$usuario['nombre'];

        // cuando el nombre de usuario existe

        if($tipo_user=="DOCTOR"){

            session_start();

            $_SESSION['usuario']=$_POST['usuario'];
           

            header('Location: DOCTOR/index.php');

        }


        if($tipo_user=="ENFERMERA"){
            
            session_start();

           $_SESSION['usuario']=$_POST['usuario'];

            header('Location: ENFERMERA/index.php');

        }
        if($tipo_user=="LABORATORIO"){

            session_start();

            $_SESSION['usuario']=$_POST['usuario'];
            
            header('Location: LABORATORIO/pruebas.php');

        } 
        if($tipo_user=="ADMINISTRADOR"){

            session_start();

            $_SESSION['usuario']=$_POST['usuario'];
            
            header('Location: ADMINISTRADOR/index.php');

        }
        if($tipo_user=="PEDIATRIA"){

            session_start();

            $_SESSION['usuario']=$_POST['usuario'];
            
            header('Location: PEDIATRIA/doctor.php');

        }




        }else{

            echo 'la contrasena es incorecta';
        }

      }else{
        echo 'este usuario no existe';
      }
     
        }

    }

    $hora_actual = date("H");



    $hora = date("H:i:s");
    $hora2 = 13;
    $hora3 = 20;
     
    if($hora_actual < $hora2){
        $saludo= "Buenos días";
    }
    else if($hora_actual > $hora2 AND $hora_actual < $hora3){
        $saludo ="Buenas Tardes";
    }
    else{
        $saludo= "Buenas Noches";
    }


    $fecha_actual="";
    $vector = array(
      1 => $fecha_actual . " Nada nuevo hay bajo el sol, pero cuántas cosas viejas hay que no conocemos.",
      2 => $fecha_actual . " El verdadero amigo es aquel que está a tu lado cuando preferiría estar en otra parte.",
      3 => $fecha_actual . " La sabiduría es la hija de la experiencia.",
      4 => $fecha_actual . " Nunca hay viento favorable para el que no sabe hacia dónde va.",
      6 => $fecha_actual . " El único modo de hacer un gran trabajo es amar lo que haces - Steve Jobs",
      5 => $fecha_actual . " La felicidad es el verdadero sentimiento de plenitud que se consigue con el trabajo duro",
      7 => $fecha_actual . " Sé un punto de referencia de calidad. Algunas personas no están acostumbradas a un ambiente donde la excelencia es aceptada",
      8 => $fecha_actual . " La felicidad es el verdadero sentimiento de plenitud que se consigue con el trabajo duro",
      9 => $fecha_actual . " Si no haces que ocurran  cosas, las cosas te ocurrirán a ti",
      10 => $fecha_actual . " Trabajar en lo correcto es mucho más importante que trabajar duro",
      11 => $fecha_actual . " Los líderes son encantadores, generan mucha empatía, se ponen en el lugar del resto para saber cómo piensa y que le deben decir, utilizan bastante su inteligencia emocional",
      12 => $fecha_actual . " El trabajo obsesivo produce la locura, tanto como la pereza completa, pero con esta combinación se puede vivir",
      13 => $fecha_actual . " En medio de la dificultad yace la oportunidad",
      14 => $fecha_actual . " Los obstáculos son esas cosas espantosas que ves cuando quitas la mirada de tus metas",
      15 => $fecha_actual . " El hombre que mueve montañas comienza cargando pequeñas piedras",
      16 => $fecha_actual . " El fracaso no es lo opuesto al éxito: es parte del éxito",
      17 => $fecha_actual . " La habilidad es lo que eres capaz de hacer. La motivación determina lo que haces. La actitud determina qué tan bien lo haces",
      18 => $fecha_actual . " Somos lo que hacemos repetidamente. La excelencia, entonces, no es un acto, sino un hábito",
      19 => $fecha_actual . " No tienes que mirar toda la escalera. Para empezar, solo concéntrate en dar el primer paso",
      20 => $fecha_actual . " La felicidad no está en la mera posesión del dinero; radica en la alegría del logro, en la emoción del esfuerzo creativo",
      21 => $fecha_actual . " Haz lo único que crees que no puedes hacer. Falla en eso. Intenta otra vez. Hazlo mejor la segunda vez. Las únicas personas que nunca se caen son aquellas que nunca se suben a la cuerda floja",
      22 => $fecha_actual . " Nunca hay tiempo suficiente para hacerlo bien, pero siempre hay tiempo suficiente para hacerlo de nuevo",
      23 => $fecha_actual . " Enfócate en ser productivo en vez de enfocarte en estar ocupado",
      24 => $fecha_actual . " Trabajar en lo correcto es probablemente más importante que trabajar duro",
      25 => $fecha_actual . " El hombre no puede descubrir nuevos océanos a menos que tenga el coraje de perder de vista la costa",
      26 => $fecha_actual . " No aprendes a caminar siguiendo reglas. Aprendes haciendo y cayéndote",
      27 => $fecha_actual . " Los obstáculos no tienen por qué detenerte. Si te topas con una pared, no te des la vuelta y te rindas. Descubre cómo escalarla, atravesarla o sortearla",
      28 => $fecha_actual . " Nadie puede descubrirte hasta que tú lo hagas. Explota tus talentos, habilidades y fortalezas y haz que el mundo se siente y se dé cuenta",
      29 => $fecha_actual . " Si hay algo que te asusta, entonces podría significar que vale la pena intentarlo",
      30 => $fecha_actual . " El trabajo en equipo es el secreto que hace que gente común consiga resultados poco comunes",
      );
      $numero= rand(1,30);


    
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Dr. King
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="index.php">
              Dr.kING
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
               
               
               
                
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="#" class="btn btn-sm mb-0 me-1 btn-primary">hola como estas?  <?php  echo $saludo . '  ' . $hora;  ?></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Inicio De Sesion</h4>
                  <p class="mb-0">Porfavor Digite tu Usuario y Password</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="" autocomplete="off">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" placeholder="Usuario"  id="usuario" name="usuario" aria-label="Email" required>
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Password"  id="password" name="password" aria-label="Password" required>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Recordarme</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Acceso</button>
                     
                  
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                   Todavia no tienes usuario?
                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Admin</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/img/portada2.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative"><?php echo $saludo . ' ' . ' ' ;?></h4>
                <p class="text-white position-relative"><?php echo "$vector[$numero] "; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>