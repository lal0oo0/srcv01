<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="Primera interfaz.css">
    <title>Primera interfaz</title>
</head>
<body>
  <?php
    include("../Modelo/conexion2.php");
    $sql="select * from srcv_visitas";
    $resultado=mysqli_query($conexion.$sql);
  ?>
  <header class="header">
    <div class="logo">
        <img src="../imagenes/logo.png" alt="">
    </div>
    <div class="btn-group">
      <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Menu
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Parte del menu</a></li>
        <li><a class="dropdown-item" href="#">Parte del menu</a></li>
        <li><a class="dropdown-item" href="#">Parte del menu</a></li>
      </ul>
    </div>
    <nav>
        <ul class="nav-links">
            <li><center></center></li>

        </ul>
    </nav>
    <a href="#" class="btn"><button>Inicio</button></a>
</header>
    <script src="../js/bootstrap.min.js"></script>

<table class="table table-success table-striped">
  <tr>
    <thead>
    <th>Hora de entrada</th>
    <th>Fecha</th>
    <th>Nombre completo</th>
    <th>Empresa</th>
    <th>Asunto</th>
    <th>Hora de salida</th>
    <th>Acciones</th>
    </thead>
  </tr>
  <tr>
    <tbody>
      <?php
      while($filas  = mysqli_fetch_assoc($resultado)){
      ?>
      <tr>
    <td><?php echo $filas['HORA_ENTRADA'] ?></td>
    <td><?php echo $filas ['FECHA'] ?></td>
    <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
    <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
    <td><?php echo $filas[''] ?></td>
    <td><?php echo $filas['ID_VISITA'] ?></td>
    <td><?php echo $filas['ID_VISITA'] ?></td>
      </tr>
      <?php
    }
      ?>
    </tbody>
  </tr>
</table>
<a href="#">Mas</a>
</body>
</html>