<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Historial de visitas</title>
</head>
<style>

   .navbar-custom {
    background-color: #1947AF; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 500px;
  overflow: auto;
  }
  .table-wrapper-scroll-y {
  display: block;
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_visitas");
  ?>
 
  <header>
  <nav class="navbar navbar-expand-lg  navbar-dark navbar-custom">
  <!--<nav  class="navbar navbar-expand-lg navbar-light bg-light navbar-with-bg">--> <!-- IMAGEN DE FONDO -->
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/logo_it.png" width="60px"> SRCV Historial de Visitas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../imagenes/menu3.png" width="40px">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Historial</a></li>
            <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
            <li><a class="dropdown-item" href="#">Cerrar Aplicacion</a></li>
          </ul>
        </li>
      </ul>
      <div class="container">
        <div class="row">
            <div class="col-md-7">
            </div>
            <div class="col-md-5">
      <form class="d-flex ">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      </div>
      </div>
      </div>
    </div>
  </div>
</nav>
</header>
<br>
<div class="container">
  <div class="row">
    <div class="col-*-*">
    <div class="table-responsive my-custom-scrollbar">
  <!-- Estos son datos de ejemplo -->
  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">Hora de entrada</th>
        <th scope="col">Fecha</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido Paterno</th>
        <th scope="col">Apellido Materno</th>
        <th scope="col">Empresa</th>
        <th scope="col">Asunto</th>
        <th scope="col">Hora de salida</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
            while ($filas = mysqli_fetch_assoc($query)) {
            ?>
      <tr>
      <td><?php echo $filas['HORA_ENTRADA'] ?></td>
                    <td><?php echo $filas['FECHA'] ?></td>
                    <td><?php echo $filas['NOMBRE'] ?></td>
                    <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                    <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                    <td><?php echo $filas['EMPRESA'] ?></td>
                    <td><?php echo $filas['ASUNTO'] ?></td>
                    <td><?php echo $filas['HORA_SALIDA'] ?></td>
                    <td>
                        <a href="#"><img src="../imagenes/actualizar.png" width="20px"></a>
                        <a href="#"><img src="../imagenes/borra.png" width="20px"></a>
                    </td>
      </tr>
      <?php
            }
            ?>
    </tbody>
  </table>

</div>
    </div>
    
  </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            hola
        </div>
        <div class="col-md-3">
        <div class="d-grid gap-2">
  <button class="btn btn-primary" style="background-color:#008000;" type="button"><img src="../imagenes/excel.png" width="35px">Informe </button>
</div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>