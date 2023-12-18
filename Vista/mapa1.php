<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Mapa</title>
</head>
<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query($conexion, "select * from srcv_salas");
  ?>
<style>
.navbar-custom {
    background-color: #F73B3B;
    font-size: 18px;
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
  .outer-container {
    display: flex;
    flex-wrap: wrap;
    max-height: 700px;
    align-items: flex-start;
    justify-content: space-around;
    width: 100%;
    padding: 20px;
  }
  .inner-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;
  }
  .caja {
    background-color: #158C10;
    box-sizing: border-box;
    width: 100px;
    height: 100px;
    margin: 20px;
    color: white;
    border-radius: 10px;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
</style>
<header>
  <nav class="navbar navbar-dark  fixed-top navbar-custom">
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
              <a class="nav-link" href="#">Mapa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="Registro_Salas.php">Registro de salas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Historial_Reservaciones.php">Historial de reservaciones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cerrar Sesion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cerrar Aplicacion</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<br><br><br><br><br>

<div class="outer-container text-center">
  <div class="inner-container">
    <?php
    while ($filas = mysqli_fetch_assoc($query)) {
      ?>
     
      <button type="button" class="btn caja">
        <?php echo $filas['NOMBRE'] ?>
      </button>
        
      
      <?php
    }
    ?>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>