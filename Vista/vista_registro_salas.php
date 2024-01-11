
<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
$correo = $_SESSION["correo"];
$sql  = "SELECT CORREO_ELECTRONICO, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo' ";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>
<?php
$mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Registros de espacios</title>
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
  height: 350px;
  overflow: auto;
  }

  .table-wrapper-scroll-y {
  display: block;
  }

  .tit-color{
    color:white;
  }

  .caja{
    border: 1px solid #B0ADAD;
    padding: 20px;
    height: 50px;
    display: flex;
    align-items: center;
  }

  .caja2{
    border: 1px solid #B0ADAD;
    padding: 20px;
    height: 90px;
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
        <h3 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel"> Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_mapa_salas.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_historial_reservaciones.php">Reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" aria-current="page" href="vista_registro_salas.php">Registro de espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_reservaciones_canceladas.php">Historial de reservaciones</a>
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
<br>
<br>
<h3 class="text-center">LISTA DE ESPACIOS URSPACE</h3> 

<!--Registrar nueva sala-->
<div class="mb-5"></div> <!--Salto de linea-->
  <div class="container caja">
    <div class="row">
      <div class="col-md-12">
      <label for="Nombre" class="col-form-label">Registro de un nuevo espacio</label>
      </div>
    </div>
  </div>
  <div class="container caja2">
    <div class="row">
      <div class="col-md-12">
        <form action="../Controlador/controlador_registro_salas.php" class="formulario" method="post">
          <div class="row g-3 align-items-center">
            <div class="col-md-2">
            <label for="Nombre" class="col-form-label">Nombre del espacio:</label>
            </div>
            <div class="col-md-6">
            <input type="text" class="form-control" name="Nombre" placeholder="Ingresa el nombre del espacio" aria-label="Nombre" aria-describedby="basic-addon1" required>
            </div>
            <div class="col-md-1">
            <button type="submit" class="btn btn-danger">AGREGAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="mb-4"></div> <!--Salto de linea-->
      <!-- ALERTA -->
      <div id="mensaje">
        <?php echo $mensaje; ?>
      </div>
      <div class="mb-3"></div>
  <div class="container">
    <div class="row">
      <div class="col">
      <div class="table-responsive my-custom-scrollbar">
      <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del espacio</th>
            <th scope="col">Estatus</th>
            <th scope="col">Acciones</th>
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
          <td><?php
          if($filas["ESTATUS"]==='0'){
          $filas["ESTATUS"]='Inactivo';
        }elseif($filas['ESTATUS']==='1'){
          $filas["ESTATUS"]='Activo';
        }
        echo$filas["ESTATUS"];
          ?></td>
          <td>
            <a href="../Controlador/controlador_activar_espacio.php?id=<?=$filas['ID_SALA']?>"><i class="fa fa-check" aria-hidden="true"></i></a>
            <a href="../Controlador/controlador_desactivar_espacio.php?id=<?=$filas['ID_SALA']?>"><i class="fa fa-times" aria-hidden="true"></i></a>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>

<script>
// Espera a que el documento HTML esté completamente cargado antes de ejecutar el script
$(document).ready(function() {
    // Captura el evento de envío del formulario con la clase 'formulario'
    $(".formulario").submit(function(e) {
        // Previene el comportamiento predeterminado del formulario
        e.preventDefault();
        
        // Realiza una solicitud Ajax al servidor
        $.ajax({
            // Especifica el método de la solicitud (POST en este caso)
            type: "POST",
            // Obtiene la URL del atributo 'action' del formulario
            url: $(this).attr('action'),
            // Serializa los datos del formulario para enviarlos al servidor
            data: $(this).serialize(),
            // Especifica que se espera recibir datos en formato JSON
            dataType: "json",
            // Función que se ejecuta cuando la solicitud Ajax tiene éxito
            success: function(response) {
                // Verifica si la operación en el servidor fue exitosa
                if (response.success) {
                    // Muestra una alerta de éxito con SweetAlert
                    swal({
                        title: 'Registro exitoso!',
                        text: 'La sala ya se encuentra registrada exitosamente!',
                        icon: 'success'
                    }).then(function() {
                        // Recarga la página después de cerrar la alerta (opcional)
                        location.reload();
                    });
                } else {
                    // Muestra una alerta de error con SweetAlert
                    swal('Error', response.error, 'error');
                }
            }
        });
    });
});
</script>

</body>
</html>