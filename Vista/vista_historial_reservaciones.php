<?php
$id=$_GET["id"];
echo $id;
?>
<?php
$mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
?>


<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
$correo = $_SESSION["correo"];
$sql  = "SELECT CORREO_ELECTRONICO, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo' ";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Reservaciones</title>
</head>

<style>
.navbar-custom {
    background-color: #F73B3B; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 400px;
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
        <h3 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel"> Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_mapa_salas.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_registro_salas.php">Registro de salas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../Controlador/controlador_cerrar_sesion.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</header>
<br>
<br>
<br>
<h3 class="text-center">HISTORIAL DE RESERVACIONES</h3>
<br>
<br>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" id="mensaje">
    <?php echo $mensaje; ?>
  </div>
  <div class="col md-1"></div>
</div>
<div class="mb-3"></div>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nombre del cliente</th>
              <th scope="col">Apellido paterno</th>
              <th scope="col">Apellido Materno</th>
              <th scope="col">Sala</th>
              <th scope="col">Correo electrónico</th>
              <th scope="col">Fecha de entrada</th>
              <th scope="col">Fecha de salida</th>
              <th scope="col">Hora de entrada</th>
              <th scope="col">Hora de salida</th>
              <th scope="col">Total</th>
              <th scope="col">Enganche</th>
              <th scope="col">Liquidación</th>
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
              <td>
                

                  <!-- Modificar reservaciones -->
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_RESERVACION'] ?>" onclick="Reservacion('<?php $filas['ID_RESERVACION'] ?>')"> <i class="fa fa-clock-o" aria-hidden="true"></i></a>
                  <!-- Modal para modificar reservaciones-->
                  <div class="modal fade" id="exampleModal_<?php echo $filas['ID_RESERVACION'] ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar reservacion de <?= $filas['NOMBRE_CLIENTE'] ?></h1>
                          <input id="Reservacion_<?php echo $filas['ID_RESERVACION'] ?>" name="Reservacion" value="" hidden>
                            <input type="hidden" name="idreservacion" id="idreservacion" value="<?php echo $filas['ID_RESERVACION'] ?>">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3"></div> <!--Salto de linea-->

                        <div class="modal-body">
                          <form action="../Controlador/controlador_posponer_reservacion.php" class="formulario row g-3 needs-validation" method="post" novalidate>
                            <div class="mb-3"></div> <!-- Salto de línea -->
                              <input type="hidden" name="id" value="<?= $filas['ID_RESERVACION'] ?>">
                            <div class="row">
                              <div class="col">
                                <label for="Fecha inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" name="Fechainicio" value="<?=$filas['FECHA_ENTRADA']?>" placeholder="Fecha de inicio" aria-label="Fecha  de inicio" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                              <div class="col">
                                <label for="Fecha finalizacion">Fecha de finalizacion</label>
                                <input type="date" class="form-control" name="Fechafinalizacion" value="<?=$filas['FECHA_SALIDA']?>" placeholder="Fecha de finalizacion" aria-label="Fecha  de finalizacion" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                            </div>
                            <div class="mb-2"></div> <!--Salto de linea-->

                            <div class="row">
                              <div class="col">
                                <label for="Hora inicio">Hora de inicio</label>
                                <input type="time" class="form-control" name="Horainicio" value="<?=$filas['HORA_ENTRADA']?>" placeholder="Hora de inicio" aria-label="Hora de inicio" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                              <div class="col">
                                <label for="Hora finalizacion">Hora de finalización</label>
                                <input type="time" class="form-control" name="Horafinalizacion" value="<?=$filas['HORA_SALIDA']?>"placeholder="Hora de finalizacion" aria-label="Hora  de finalizacion" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>   
                              </div>     
                            </div>
                            <div class="mb-3"></div> <!--Salto de linea-->

                          <div class="row">
                            <div class="col">
                              <input type="hidden" name="Total" value="<?= $filas['TOTAL'] ?>">
                            </div>
                            <div class="col">
                              <label for="Enganche">Enganche
                              </label>
                              <input type="number" class="form-control" name="Enganche" value="<?=$filas['ENGANCHE']?>" placeholder="Enganche" aria-label="Enganche" aria-describedby="basic-addon1" required>
                              <div class="invalid-feedback">
                                Verifique los datos
                              </div>
                            </div>
                            <div class="col"><input type="hidden" name="Liquidacion" value="<?= $filas['LIQUIDACION'] ?>"></div>
                          </div>
                            <div class="mb-5"></div> <!--Salto de linea-->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Confirmar</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Boton para eliminar-->
                  <a href="" name="id" onclick="cancelar('<?php $filas['ID_RESERVACION'] ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        
                
              </td>
          </tr>
          <?php
          };
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="mb-3"></div> 
<div class="row">
  <div class="col-md-10">
  </div>
  <div class="col-md-2">
  <button class="btn btn-primary" style="background-color:#008000;"  type="button"><img src="../imagenes/excel.png" width="35px">Informe </button>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>

<script>

function Reservacion(idreservacion){
    document.getElementById('Reservacion_' + idreservacion).value = idreservacion;
    <?php $id_reservacion ?>=idreservacion;
    }

// Script para validaciones
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

</script>

</body>
</html>