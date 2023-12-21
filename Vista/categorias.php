<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Agregar Listas</title>
</head>
  <?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $categorias = mysqli_query ($conexion, "select * from srcv_listas");
  ?>
<style>

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
  .navbar-custom{
    background-color: #64BAFF; 
    font-size: 18px;
  }
  .Titulo{
    color:white;
  }
</style>
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
            <a class="nav-link active" href="http://localhost/srcv01/Vista/admin.php">Usuarios</a>
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
<br>
<div class="container">

  <div class="row">
    <div class="col-12">
    <button type="button" class="btn btn-primary" style="background-color:	#008B8B;" >Nuevo Registro</button>
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
        <th scope="col">Nombre</th>
        <th scope="col">Categoria</th>
      </tr>
    </thead>
    <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "select * from srcv_listas");
            
            while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo$filas ["ID_LISTA"] ?></td>
            <td><?php echo$filas ["NOMBRE"] ?></td>
            <td><?php echo$filas ["CATEGORIA"] ?></td>
        </tr>
        <?php
        };
        ?>
  </table>

</div>
    </div>
    
  </div>
</div>

<div class="container caja">
  <div class="row">
    <div class="col-md-12">
      <form action="../Controlador/controlador_registro_categoria.php" class="formulario" method="post">
        <div class="row g-3 align-items-center">
          <div class="col-md-2">
          <label for="Nombre" class="col-form-label">Nombre:</label>
          </div>
          <div class="col-md-6">
          <input type="text" class="form-control" name="Nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1">
          </div>
          <div class="col-md-3">
          <select class="form-select" name="Categoria" aria-label="Default select example">
            <option selected>Categoria</option>
            <option value="1">
              <?php
              while ($filas = mysqli_fetch_assoc($categorias)) 
              {
              ?>
              <option value="">
                  <?php echo $filas['CATEGORIA']; ?>
              </option>
              <?php
              }
              ?>
            </option>
          </select>
          </div>
          <div class="col-md-1">
          <button type="submit" class="btn btn-danger">AGREGAR</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>