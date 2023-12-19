<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Reservaciones</title>
</head>
<style>
.navbar-custom {
    background-color: #F73B3B; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }
  table.table th,
  table.table td {
    text-align: center;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 200px;
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

<nav class="navbar navbar-dark fixed-top navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img id="logo" src="../imagenes/Logo-Urspace.png" width="95">SRCV SALAS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="mapa1.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Registro_Salas.php">Registro de salas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Historial_Reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cerrar Aplicacion</a>
          </li>
      </div>
    </div>
  </div>
</nav>
</header>
<br>
<br>
<br>
<br>
<h3><center>HISTORIAL DE RESERVACIONES</center></h3>
<br>
<div class="container">
  <div class="row">
    <div class="col">
    <div class="table-responsive my-custom-scrollbar">
  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Apellido paterno</th>
        <th scope="col">Apellido Materno</th>
        <th scope="col">ID Sala</th>
        <th scope="col">Correo electronico</th>
        <th scope="col">Fecha de entrada</th>
        <th scope="col">Fecha de salida</th>
        <th scope="col">Hora de entrada</th>
        <th scope="col">Hora de salida</th>
        <th scope="col">Total</th>
        <th scope="col">Enganche</th>
        <th scope="col">Liquidacion</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "select * from srcv_reservaciones");
            while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo$filas ["ID_RESERVACION"] ?></td>
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