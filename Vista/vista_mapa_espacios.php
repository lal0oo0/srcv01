<?php
session_start();
$ROL=$_SESSION['rol'];
$CORREO=$_SESSION['correo'];
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}
?>

<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
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
    <title>Mapa salas</title>
</head>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query($conexion, "select * from srcv_salas WHERE ESTATUS = 1");
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

  .botonocupado {
    background-color: #ED250A;
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
              <a class="nav-link active" aria-current="page" href="vista_mapa_espacios.php">Mapa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="vista_reservaciones_urspace.php">Reservaciones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
            </li>
            <li class="nav-item">
              <a class="sesion nav-link" aria-current="page" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
<?php
  date_default_timezone_set('America/Mexico_City');
  $fecha_actual = date("Y-m-d");
  $hora_actual = date("H:i");
  ?>
<br><br><br><br><br>
<h3 class="text-center">MAPA DE ESPACIOS</h3>

<div class="outer-container text-center">
  <div class="inner-container">
    <?php
    ///////este es el ciclo que muestra las salas
    while ($filas = mysqli_fetch_assoc($query)) {
    ?>
     <?php
     ////Recupera el id de la sala
     $ID = $filas['ID_SALA'];
     ////esta consulta nos va a permitir buscar si
     ////uno de los espacios tiene una reservacion
     $ocupado= mysqli_query($conexion, "SELECT * FROM srcv_reservaciones WHERE ID_SALA='$ID'");
     $ocu = mysqli_fetch_assoc($ocupado);?>
     <?php
     //Que la hora actual este entre la hora de entrada y la de salida
     if (($filas['RESERVADA'])==1 && ($ocu['FECHA_ENTRADA']) <= $fecha_actual && ($ocu['FECHA_SALIDA'])>= $fecha_actual && ($ocu['HORA_ENTRADA'])<=$hora_actual && ($ocu['HORA_SALIDA'])>=$hora_actual){
      ?>
      <button type="button" class="botonocupado btn btn-danger">
        <?php echo $filas['NOMBRE'] ?>
      </button>
      <?php
      }
     ////muestra en color verde las salas que no contengan
     ////una reservacion para la fecha y hora actual
     elseif(($filas['RESERVADA'])==0 ||($filas['RESERVADA'])==1 && ($ocu['FECHA_ENTRADA'])>$fecha_actual){
     ?>
      <!-- Button trigger modal -->
      <button type="button" class="boton btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_<?php echo $filas['ID_SALA'] ?>" onclick="setSelectedRoom('<?php echo $filas['ID_SALA'] ?>')">
       <?php echo $filas['NOMBRE'] ?>
      </button>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop_<?php echo $filas['ID_SALA'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">
                <?php echo $filas['NOMBRE']; echo " | "; echo $filas['UBICACION'];?></h1>
                <input id="salaSeleccionada_<?php echo $filas['ID_SALA'] ?>" name="salaSeleccionada" value="" hidden>
                
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../Controlador/controlador_registro_reservacion.php" class="formulario row g-3 needs-validation" method="post" novalidate>
                <input type="hidden" name="id_sala" id="id_sala" value="<?= $filas['ID_SALA'] ?>">
                <input type="hidden" name="nombre" id="nombre" value="<?= $filas['NOMBRE'] ?>">
                <div class="col">
                <label for="se">Nombre *</label>
                <input type="text" class="form-control" name="Nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1" required>
                <div class="invalid-feedback">
                  Verifique los datos
                </div>
                </div>
                <div class="mb-2"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col">
                    <label for="se">Apellido paterno *</label>
                    <input type="text" class="form-control" name="Apellidopaterno" placeholder="Apellido paterno" aria-label="Apellido paterno" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
                  <div class="col">
                    <label for="se">Apellido materno *</label>
                    <input type="text" class="form-control" name="Apellidomaterno" placeholder="Apellido materno" aria-label="Apellido materno" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
                </div>
                <div class="mb-2"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col">
                    <label for="se">Correo electrónico *</label>
                    <input type="email" class="form-control" name="Correo" placeholder="Correo electrónico" aria-label="Correo electronico" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
                  <div class="col">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="Telefono" placeholder="Teléfono" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="mb-2"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col">
                    <label for="Fecha inicio">Fecha de inicio *</label>
                    <input type="date" class="form-control" id="Fechainicio" name="Fechainicio" placeholder="Fecha de inicio" aria-label="Fecha  de inicio" aria-describedby="basic-addon1" min="<?=$fecha_actual?>" value="<?=$fecha_actual?>" required>
                    <div class="invalid-feedback">
                    Verifique los datos
                    </div>
                  </div>
                  <div class="col">
                    <label for="Fecha finalizacion">Fecha de finalizacion *</label>
                    <input type="date" class="form-control" id="Fechafinalizacion" name="Fechafinalizacion" placeholder="Fecha de finalizacion" aria-label="Fecha  de finalizacion" aria-describedby="basic-addon1" min="<?=$fecha_actual?>" required>
                    <div class="invalid-feedback">
                    Verifique los datos
                    </div>
                  </div>
                </div>
                <div class="mb-2"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col">
                    <label for="Hora inicio">Hora de inicio *</label>
                    <input type="time" class="form-control" name="Horainicio" placeholder="Hora de inicio " aria-label="Hora de inicio" aria-describedby="basic-addon1" value="<?=$hora_actual?>" required>
                    <div class="invalid-feedback">
                    Verifique los datos
                    </div>
                  </div>
                  <div class="col">
                    <label for="Hora finalizacion">Hora de finalización *</label>
                    <input type="time" class="form-control" name="Horafinalizacion" placeholder="Hora de finalizacion " aria-label="Hora  de finalizacion" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">
                    Verifique los datos
                    </div>   
                  </div>     
                </div>
                <div class="mb-2"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                  <label for="personas">Numero de personas</label>
                  <input type="number" class="form-control" name="Personas" value="1" aria-label="personas" aria-describedby="basic-addon1">
                  </div>
                  <div class="col-md-3"></div>
                </div>

                <div class="col">
                  <label for="se">Servicios extra</label>
                  <input type="text" class="form-control" name="Servicios" value="N/A" aria-label="servicios" aria-describedby="basic-addon1">
                </div>
                <div class="mb-4"></div> <!--Salto de linea-->

                <div class="row">
                  <div class="col">
                    <label for="se">Total *</label>
                    <input type="number" class="form-control" name="Total" placeholder="Total" aria-label="Total" aria-describedby="basic-addon1" id="monto" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
                  <div class="col">
                    <label for="se">Enganche *</label>
                    <input type="number" class="form-control" name="Enganche" placeholder="Enganche" aria-label="Enganche" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
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
        
      <?php
      ////a partir de aqui se imprimen en color rojo los espacios
      ////que contengan una reservacion para la fecha y hora actual
      }//else
      ?>
    <?php
    }
    ///////aqui finaliza el ciclo que muestra los espacios
    ?>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

<script>
  function setSelectedRoom(idSala) {
    // Asigna el ID de la sala al campo oculto en el formulario
    document.getElementById('salaSeleccionada_' + idSala).value = idSala;
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


//ALERTAS//
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
                        text: 'Su reservacion fue registrada con éxito!',
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