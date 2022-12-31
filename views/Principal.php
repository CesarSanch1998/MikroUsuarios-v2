<?php
include('../funcionalidad/ResourceMikrotik.php');
include('../funcionalidad/formatbytesbites.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Core CSS -->
  <!--<link rel="stylesheet" href="../css/core.css" class="template-customizer-core-css" />-->

  <title>Principal</title>
</head>

<body>

  <!--Cabecera en donde estan las opciones proncipales---------------------------------------->
  <h1 class="visually-hidden">Headers examples</h1>

  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">MikroUsuarios</span>
      </a>

      <ul class="nav nav-pills">

        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Principal</a></li>
        <li class="nav-item"><a href="../views/Activos.php" class="nav-link">Activos</a></li>
        <li class="nav-item"><a href="../views/Vencidos.php" class="nav-link">Vencidos</a></li>
        <li class="nav-item"><a href="../views/Deudores.php" class="nav-link">Deudores</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pausados</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Historial
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Creados-Registros</a></li>
            <li><a class="dropdown-item" href="#">Pagos-Registros</a></li>
          </ul>
        </li>
    </header>
  </div>

  <div class="b-example-divider"></div>
  <!--Cabecera en donde estan las opciones proncipales---------------------------------------->

  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-6 col-xl-4">
        <div class="card shadow-none bg-transparent border border-primary mb-3">
          <div class="card-body">
            <h4 class="card-title">Datos del Equipo</h4>
            <div class="row">
              <h7 id="ram">Memoria Ram Libre: <?php echo formatBytes($resource['free-memory'], 2) ?></h7>
            </div>
            <div class="row">
              <h7>Memoria HDD: <?php echo formatBytes($resource['free-hdd-space'], 2) ?></h7>
            </div>
            <div class="row">
              <h7>Nombre Mikrotik: <?php echo $resource['board-name']; ?></h7>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-xl-4">
        <div class="card shadow-none bg-transparent border border-primary mb-3">
          <div class="card-body">
            <h4 class="card-title">Datos del Equipo</h4>
            <div class="row">
              <h7 id="CPU">CPU: <?php echo $resource['cpu-load']; ?> %</h7>
            </div>
            <div class="row">
              <h7 id="temperatura">Temperatura: <?php echo $temperatura[1]['value']; ?> C</h7>
            </div>
            <div class="row">
              <h7 id="tiempo">Tiempo Encendido: <?php echo $resource['uptime']; ?></h7>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- cuadros de datos mikrotik -->
    <h4 class="pb-1 mb-5">Datos:</h4>
    <div class="row">
      <div class="col-sm-6 col-md-2 col-xl-3">
        <div class="card bg-primary text-white mb-3">
          <div class="card-body">
            <h5 class="card-title text-white">
              <center>Users en Mikrotik</center>
            </h5>
            <p class="card-text">
              <center>
                <h2 class="text-white"><?php echo $getusers; ?></h2>
              </center>
            </p>
            <center>
              <a href="./UsuariosCreadosMikrotik.php" class="card-link text-white">Ver Mas</a>
            </center>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-2 col-xl-3">
        <div class="card bg-success text-white mb-3">
          <div class="card-body">
            <h5 class="card-title text-white">
              <center>Users Activos Mikrotik</center>
            </h5>
            <p class="card-text">
              <center>
                <h2 class="text-white"><?php echo $getusersactive; ?></h2>
              </center>
            </p>
            <center>
              <a href="./UsuariosActivosMikrotik.php" class="card-link text-white">Ver Mas</a>
            </center>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-2 col-xl-3">
        <div class="card bg-danger text-white mb-3">
          <div class="card-body">
            <h5 class="card-title text-white">
              <center>Users Vencidos</center>
            </h5>
            <p class="card-text">
              <center>
                <h2 class="text-white">15</h2>
              </center>
            </p>
            <center>
              <a href="./Vencidos.php" class="card-link text-white">Ver Mas</a>
            </center>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-2 col-xl-3">
        <div class="card bg-info text-white mb-3">
          <div class="card-body">
            <h5 class="card-title text-white">
              <center>Users Pase Libre</center>
            </h5>
            <p class="card-text">
              <center>
                <h2 class="text-white"><?php echo $Activosip_bindin ?></h2>
              </center>
            </p>
            <center>
              <a href="#" class="card-link text-white">Ver Mas</a>
            </center>
          </div>
        </div>
      </div>

    </div>

    <!--/ Style variation -->
  </div>


  <!--Scripts-------------------------------------------------------------------------->
  <script src="../js/bootstrap.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      setInterval('actualizarrecursos()',2000);
      
      function actualizarrecursos() {
        $.ajax({
          url: '../funcionalidad/ResourceMikrotik.php',
          type: 'GET',
          success: function(respuesta) {
            let formato = "";
            let json = JSON.parse(respuesta);
            $('#tiempo').val(json.TEncendido);
          }
        })
      }


    });
  </script>

  <!--Scripts-------------------------------------------------------------------------->
</body>

</html>