<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Primera interfaz.css">
    <title>Primera interfaz</title>
</head>
<body>
  <?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_visitas");
  ?>
  <header class="header">
    <div class="logo">
        <img src="../imagenes/logo.png" alt="">
    </div>

    <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Historial</a></li>
    <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Cerrar aplicacion</a></li>
  </ul>
</div>

    <a href="#" class="btn"><button>Inicio</button></a>
</header>
<br>
<table class="table table-success table-striped">
  <tr>
    <thead>
    <th>Hora de entrada</th>
    <th>Fecha</th>
    <th>Nombre</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Empresa</th>
    <th>Asunto</th>
    <th>Hora de salida</th>
    <th>Acciones</th>
    </thead>
  </tr>
  <tr>
    <tbody>
      <?php
      while($filas  = mysqli_fetch_assoc($query)){
      ?>
      <tr>
    <td><?php echo $filas['HORA_ENTRADA'] ?></td>
    <td><?php echo $filas ['FECHA'] ?></td>
    <td><?php echo $filas['NOMBRE'] ?></td>
    <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
    <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
    <td><?php echo $filas['EMPRESA'] ?></td>
    <td><?php echo $filas['ASUNTO'] ?></td>
    <td><?php echo $filas['HORA_SALIDA'] ?></td>
    <td>iconos</td>
      </tr>
      <?php
    }
      ?>
    </tbody>
  </tr>
</table>
<a href="#">Mas</a>


<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>