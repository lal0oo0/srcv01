<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}

$ROL=$_SESSION['rol'];
// Verificar el rol del usuario
if ($ROL !== "urspace") {
  // Si el usuario no tiene el rol correcto, redirigir a la página de inicio de sesión
  header("location: vista_inicio_sesion.php");
  exit();
}

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
<body>
<?php
  require_once("../Modelo/conexion2.php");
  $conexion = conect();
  $piso = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='Piso' and ESTATUS='1'");
  ?>
<header>
<nav class="navbar navbar-dark  fixed-top navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img id="logo" src="../imagenes/Logo-Urspace.png" width="95">SRCV URSPACE</a>
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
            <a class="nav-link" aria-current="page" href="vista_mapa_espacios.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_reservaciones_urspace.php">Reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_visitas_urspace.php">Visitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesión</a>
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
        <form action="../Controlador/controlador_registro_espacios.php" class="formulario" method="post">
          <div class="row g-3 align-items-center">
            <div class="col-md-2">
            <label for="Nombre" class="col-form-label">Nombre del espacio:</label>
            </div>
            <div class="col-md-4">
            <input type="text" class="form-control" name="Nombre" placeholder="Ingresa el nombre del espacio" aria-label="Nombre" aria-describedby="basic-addon1" required>
            </div>
            <div class="col-md-1">
              <label for="Ubicacion" class="col-form-label">Ubicación:</label>
            </div>
            <div class="col-md-3">
            <select class="form-select mr-sm-2" id="ubicacion" name="ubicacion" required>
                      <div class="invalid-feedback">
                        Verifique los datos
                      </div>
                      <option selected value="">Selecciona</option>
                      <!--Se muestran las opciones de "Pisos" registradas en la tabla listas-->
                      <?php
                      while ($filas = mysqli_fetch_assoc($piso)) {
                      ?>
                        <option value="<?php echo $filas['NOMBRE']; ?>">
                          <?php echo $filas['NOMBRE']; ?>
                        </option>
                      <?php
                      }
                      ?>
                    </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
            <button type="submit" class="btn btn-danger">AGREGAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<div class="mb-4"></div> <!--Salto de linea-->
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10" id="mensaje">
     <?php echo $mensaje; ?>
    </div>
    <div class="col md-1"></div>
  </div>
<div class="mb-3"></div><!--Salto de linea-->
  <div class="container">
    <div class="row">
      <div class="col">
      <div class="table-responsive my-custom-scrollbar">
      <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col">Nombre del espacio</th>
            <th scope="col">Ubicación</th>
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
          <td><?php echo$filas ["NOMBRE"] ?></td>
          <td><?php echo$filas ["UBICACION"] ?></td>
          <td><?php
          if($filas["ESTATUS"]==='0'){
          $filas["ESTATUS"]='Inactivo';
          }elseif($filas['ESTATUS']==='1'){
          $filas["ESTATUS"]='Activo';
          }
         echo$filas["ESTATUS"];
          ?></td>
          <td>
            <a href="../Controlador/controlador_activar_espacio.php?id=<?=$filas['ID_SALA']?>" class="link-danger"><i class="fa fa-check" aria-hidden="true"></i></a>
            <a href="../Controlador/controlador_desactivar_espacio.php?id=<?=$filas['ID_SALA']?>" class="link-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
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
                        text: 'El espacio ya se encuentra registrado exitosamente!',
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



//Script para poner por tiempos las alertas de bootstrap

    // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el elemento de alerta
        var alerta = document.querySelector('.alert');

        // Verifica si se encontró el elemento de alerta
        if(alerta) {
            // Temporizador para eliminar la alerta después de 4 segundos (4000 milisegundos)
            setTimeout(function() {
                alerta.remove(); // Elimina la alerta del DOM
            }, 4000);
        }
    });

</script>


<!--script para mostrar alerta de confirmación antes de cerrar sesión-->
<script>
  function cerrarsesion(event) {
    // Previene el comportamiento predeterminado del enlace
    event.preventDefault();

    // Muestra la alerta de SweetAlert
    swal("¿Estás seguro de que deseas cerrar sesión?", {
      buttons: ["Cancelar", "Aceptar"],
    }).then(function (confirmed) {
      // confirmed será true si se hace clic en "Aceptar", false si se hace clic en "Cancelar"
      if (confirmed) {
        // Realiza una solicitud Ajax al servidor para cerrar sesión
        $.ajax({
          type: "POST",
          url: "../Controlador/controlador_cerrar_sesion.php",
          //data: { key1: 'value1', key2: 'value2' },
          dataType: "json",
          success: function(response) {
            if (response.success) {
                // Redirige a otra interfaz después de cerrar la alerta (opcional)*/
                window.location.href = "../Vista/vista_inicio_sesion.php";
            } else {
              // Muestra una alerta de error con SweetAlert
              swal('Error', response.error, 'error');
            }
          }
        });
      }
    });
  }
</script>
</body>
</html>