<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Registros de salas</title>
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
            <a class="nav-link" href="mapa1.php">Mapa</a>
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
      </div>
    </div>
  </div>
</nav>
</header>
<br>
<br>
<br>
<br>
<h3><center>REGISTROS DE SALAS</center></h3>
<br>


<!-- Button trigger modal -->
<div class="container">
  <div class="row">
    <div class="col-md-12">

    <form action="" class="formulario" method="post">
      <div class="row g-3 align-items-center">
        <div class="col-md-2">
        <label for="Nombre" class="col-form-label">Nombre de la sala:</label>
        </div>
        <div class="col-md-9">
        <input type="text" class="form-control" name="Nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1">
        </div>
      </div>
    </form>

    
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
      NUEVO REGISTRO
    </button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="container">
  <div class="row">
    <div class="col">
    <div class="table-responsive my-custom-scrollbar">
  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre de la Sala</th>
        <th scope="col">Estatus</th>
      </tr>
    </thead>
    <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "select * from srcv_salas");
            while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo$filas ["ID_SALA"] ?></td>
            <td><?php echo$filas ["NOMBRE"] ?></td>
            <td><?php echo$filas ["ESTATUS"] ?></td>
        </tr>
        <?php
        };
        ?>
  </table>
</div>
    </div> 
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>