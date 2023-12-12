<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="Salas.css">
    <title>Salas</title>
</head>
<body>
<header class="header">
<div class="dropdown-center">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    MENU
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Inicio</a></li>
    <li><a class="dropdown-item" href="#">Action two</a></li>
    <li><a class="dropdown-item" href="#">Action three</a></li>
  </ul>
</div>
</header>

<div class="row">
    <div class="col">
        <table class="table table-danger">
            <tr class="table-danger">
                <td>Id</td>
                <td>Nombre de la sala</td>
                <td>Estatus</td>
            </tr>
    </div>
</div>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_salas");
    while($filas  = mysqli_fetch_assoc($query)){
  ?>
  <tr class="table-danger">
    <td><?php echo$filas ["ID_SALA"] ?></td>
    <td><?php echo$filas ["NOMBRE"] ?></td>
    <td><?php echo$filas ["ESTATUS"] ?></td>
  </tr>
  <?php
  };
  ?>


</body>
</html>