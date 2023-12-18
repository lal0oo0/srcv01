<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Registar</title>
</head>
<style>

   .navbar  {
    background-color: #8E4566; /* Darle color al NAV, del color que se necesite */
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
  .navbar-custom {
    background-color: #64BAFF; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }
  .Titulo{
    color: white;
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_visitas");
  ?>
 
  <header>
  <nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/logo_it.png" width="60px"> SRCV Registros</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title Titulo" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" href="http://localhost/srcv01/Vista/srcv_historial1.php">Historial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Cerrar Aplicacion</a>
          </li>
        </ul>
        </ul>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="Buscar" placeholder="Buscar" aria-label="Buscar">
          <button class="btn btn-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</nav>
</header>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        <div class="d-grid gap-2">
  <button class="btn btn-primary" style="background-color:	#008B8B;" type="button">Nuevo </button>
</div>
        </div>
    </div>
</div>
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
                        <a href="#"><button type="button" class="btn btn-secondary btn-sm" style="background-color:	#8AB7B0;"><img src="../imagenes/actualizar.png" width="20px"></button></a>
                        <a href="#"><button type="button" class="btn btn-secondary btn-sm" style="background-color:	#8AB7B0;"><img src="../imagenes/borra.png" width="20px"></button></a>
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

<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>