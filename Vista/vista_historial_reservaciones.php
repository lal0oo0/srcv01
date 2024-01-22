<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
$correo = $_SESSION["correo"];
$sql  = "SELECT CORREO_ELECTRONICO, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo' ";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Reservaciones</title>
</head>

<style>
  .navbar-custom {
    background-color: #F73B3B; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 350px;
  overflow: auto;
  }

  .table-wrapper-scroll-y {
  display: block;
  }

  .tit-color{
    color:white;
  }

</style>

<header>
<nav class="navbar navbar-dark  fixed-top navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img id="logo" src="../imagenes/Logo-Urspace.png" width="95">SRCV URSPACE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel"> Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_mapa_espacios.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_reservaciones_urspace.php">Reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../Controlador/controlador_cerrar_sesion.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </div>  
</nav>
</header>
<br><br><br>
<div class="mb-5"></div> <!--Salto de linea-->
<h3 class="text-center">HISTORIAL DE RESERVACIONES</h3>
<div class="mb-5"></div>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nombre del cliente</th>
              <th scope="col">Apellido paterno</th>
              <th scope="col">Apellido Materno</th>
              <th scope="col">Espacio</th>
              <th scope="col">Correo electrónico</th>
              <th scope="col">Fecha de entrada</th>
              <th scope="col">Fecha de salida</th>
              <th scope="col">Hora de entrada</th>
              <th scope="col">Hora de salida</th>
              <th scope="col">Total</th>
              <th scope="col">Enganche</th>
              <th scope="col">Liquidación</th>
            </tr>
          </thead>
          <?php
              require_once("../Modelo/conexion2.php");
              $conexion = conect();
              $query = mysqli_query ($conexion, "select * from srcv_reservaciones");
              while($filas  = mysqli_fetch_assoc($query)){
          ?>
          <tr>
              <td><?php echo$filas ["NOMBRE_CLIENTE"] ?></td>
              <td><?php echo$filas ["APELLIDO_PATERNO"] ?></td>
              <td><?php echo$filas ["APELLIDO_MATERNO"] ?></td>
              <td><?php echo$filas ["ID_SALA"] ?></td>
              <td><?php echo$filas ["CORREO_ELECTRONICO"] ?></td>
              <td><?php echo$filas ["FECHA_ENTRADA"] ?></td>
              <td><?php echo$filas ["FECHA_SALIDA"] ?></td>
              <td><?php echo$filas ["HORA_ENTRADA"] ?></td>
              <td><?php echo$filas ["HORA_SALIDA"] ?></td>
              <td><?php echo$filas ["TOTAL"] ?></td>
              <td><?php echo$filas ["ENGANCHE"] ?></td>
              <td><?php echo$filas ["LIQUIDACION"] ?></td>
          </tr>
          <?php
          };
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="mb-3"></div> 
<div class="row">
  <div class="col-md-10">
  </div>
  <div class="col-md-2">
  <button class="btn btn-primary" style="background-color:#008000;"  type="button"><img src="../imagenes/excel.png" width="35px">Informe </button>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>