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
  .boton {
    background-color: #158C10;
    box-sizing: border-box;
    width: 140px;
    height: 140px;
    margin: 50px;
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
     
      <!-- Button trigger modal -->
<button type="button" class="boton btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setSelectedRoom('<?php echo $filas['ID_SALA'] ?>')">

<?php echo $filas['NOMBRE'] ?>
      </button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">
          <?php echo $filas['NOMBRE'] ?></h1>
            <input  id="salaSeleccionada" name="salaSeleccionada" value="">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

    <form action="../Controlador/controlador_registro_reservacion.php" class="formulario" method="post">
      <div class="input-group mb-3">
       <input type="text" class="form-control" name="Nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1">
      </div>
      <div class="input-group mb-3">
       <input type="text" class="form-control" name="Apellidopaterno" placeholder="Apellido paterno" aria-label="Apellido paterno" aria-describedby="basic-addon1">
       <input type="text" class="form-control" name="Apellidomaterno" placeholder="Apellido materno" aria-label="Apellido materno" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group mb-6">
       <input type="email" class="form-control" name="Correo" placeholder="Correo electronico" aria-label="Correo electronico" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group mb-3">
        <div class="input-group mb-12">
        <label for="Fecha inicio">Fecha de inicio</label>
        <label for="Fecha finalizacion">
           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
          Fecha de finalizacion</label>
        </div>
        <input type="date" class="form-control" name="Fechainicio" placeholder="Fecha de inicio" aria-label="Fecha  de inicio" aria-describedby="basic-addon1">
        <input type="date" class="form-control" name="Fechafinalizacion" placeholder="Fecha de finalizacion" aria-label="Fecha  de finalizacion" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group mb-3">
        <div class="input-group mb-12">
        <label for="Hora inicio">Hora de inicio</label>
        <label for="Hora finalizacion">
           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
          Hora de finalizacion</label>
        </div>
        <input type="time" class="form-control" name="Horainicio" placeholder="Hora de inicio" aria-label="Hora de inicio" aria-describedby="basic-addon1">
        <input type="time" class="form-control" name="Horafinalizacion" placeholder="Hora de finalizacion" aria-label="Hora  de finalizacion" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group mb-3">
       <input type="number" class="form-control" name="Total" placeholder="Total" aria-label="Total" aria-describedby="basic-addon1">
       <input type="number" class="form-control" name="Enganche" placeholder="Enganche" aria-label="Enganche" aria-describedby="basic-addon1">
       <input type="number" class="form-control" name="Liquidacion" placeholder="Liquidacion" aria-label="Liquidacion" aria-describedby="basic-addon1">
      </div>
    
      <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>

        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>
        
      
      <?php
    }
    ?>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

<script>
  function setSelectedRoom(nombreSala) {
    // Asigna el nombre de la sala al campo oculto en el formulario
    document.getElementById('salaSeleccionada').value = nombreSala;
  }
</script>
</body>
</html>