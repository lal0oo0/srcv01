<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Salas.css">
    <title>Salas</title>
</head>
<body>
<header class="header">
<div class="dropdown-center">
  <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    MENU
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Inicio</a></li>
    <li><a class="dropdown-item" href="#">Mapa</a></li>
    <li><a class="dropdown-item" href="#">Historial</a></li>
    <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
    <li><a class="dropdown-item" href="#">Cerrar aplicacion</a></li>
  </ul>
</div>
</header>

<div class="row">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre de la sala</th>
                <th>Estatus</th>
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
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>