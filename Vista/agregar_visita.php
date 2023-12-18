<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Agregar</title>
</head>
<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_listas");
  ?>
    <style>

    </style>

    <h1>Agregar registro</h1>
    <div class="container text-center">
      <img class="logo" url=() alt="">
      <div class="row justify-content-center">
        <div class="col-11">
          <div class="card-body">
          <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="row g-3 needs-validation" novalidate>
            <h1>Rellene los campos</h1>

            <div class="row">
            <div class="col-sm-3">
              <label for="fecha" class="form-label">Fecha</label>
              <input type="date" class="form-control" id="fecha" disable="" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>

            <div class="col-3">
              <label for="he" class="form-label">Hora de entrada</label>
              <input type="time" class="form-control" id="he" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>
            </div>

            <div class="col-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>

            <div class="row">
            <div class="col-3">
              <label for="ap" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" id="ap" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>

            <div class="col-3">
              <label for="am" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" id="am" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>
            </div>

            <div class="row">
            <div class="col-2">
             <label class="form-label" for="empresa">Empresa</label><br>
              <select class="custom-select mr-sm-2" id="empresa">
               <option selected>Elige</option>
               <?php
    while ($filas = mysqli_fetch_assoc($query)) {
        if ($filas['CATEGORIA'] == 'empresa') {
?>
            <option value="<?php echo $filas['ID_LISTA']; ?>">
                <?php echo $filas['NOMBRE']; ?>
            </option>
<?php
        }
    }
?>
              </select>
            </div>

            <div class="col-2">
             <label class="form-label" for="asunto">Asunto</label><br>
              <select class="custom-select mr" id="asunto">
               <option selected>Elige</option>
               <option value="1">One</option>
               <option value="2">Two</option>
               <option value="3">Three</option>
              </select>
            </div>

            <div class="col-2">
              <label for="hs" class="form-label">Hora de salida</label>
              <input type="time" class="form-control" id="hs" required>
              <div class="invalid-feedback">
              Verifique los datos
              </div>
            </div>
            </div>

            <br><br><br><br>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" href="#">Aceptar</button>
            </div>
            <a href="../Vista/srcv_historial1.php">Volver</a>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>