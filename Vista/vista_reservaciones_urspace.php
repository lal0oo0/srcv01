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

  .filtro{
    display: none;
  }

  .botonconfirmar {
    background-color: #007bff; /*color boton de cerrar sesion */
  }

</style>

<header>
<nav class="navbar navbar-dark fixed-top navbar-custom">
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
            <a class="nav-link active" aria-current="page" href="vista_reservaciones_urspace.php">Reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
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
<h3 class="text-center">RESERVACIONES</h3>
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

  <!--Bucador-->
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
    </div>
  </div>
  <div class="mb-3"></div><!--Salto de linea-->

  <div class="row">
    <div class="col">
      <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nombre del cliente</th>
              <th scope="col">Espacio</th>
              <th scope="col">Correo electrónico</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Fecha de entrada</th>
              <th scope="col">Fecha de salida</th>
              <th scope="col">Hora de entrada</th>
              <th scope="col">Hora de salida</th>
              <th scope="col">Número de personas</th>
              <th scope="col">Servicios extra</th>
              <th scope="col">Total</th>
              <th scope="col">Enganche</th>
              <th scope="col">Liquidación</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <?php
              require_once("../Modelo/conexion2.php");
              $conexion = conect();
              $query = mysqli_query ($conexion, "SELECT * FROM srcv_reservaciones WHERE ESTATUS='1' AND USO='0' ORDER BY FECHA_ENTRADA DESC, HORA_ENTRADA DESC");
              while($filas  = mysqli_fetch_assoc($query)){
                $idRegistro=$filas["ID_RESERVACION"];
                $idForm='myForm_' . $idRegistro;
          ?>
          <tr class="datos">
              <td><?php echo$filas ["NOMBRE_CLIENTE"] ?>
              <?php echo$filas ["APELLIDO_PATERNO"] ?>
              <?php echo$filas ["APELLIDO_MATERNO"] ?></td>
              <td><?php echo$filas ["NOMBRE_ESPACIO"] ?></td>
              <td><?php echo$filas ["CORREO_ELECTRONICO"] ?></td>
              <td><?php echo$filas ["TELEFONO"] ?></td>
              <td><?php echo$filas ["FECHA_ENTRADA"] ?></td>
              <td><?php echo$filas ["FECHA_SALIDA"] ?></td>
              <td><?php echo$filas ["HORA_ENTRADA"] ?></td>
              <td><?php echo$filas ["HORA_SALIDA"] ?></td>
              <td><?php echo$filas ["NUMERO_PERSONAS"] ?></td>
              <td><?php echo$filas ["SERVICIOS_EXTRA"] ?></td>
              <td>$<?php echo number_format($filas ["TOTAL"], 2, '.', ',') ?></td>
              <td>$<?php echo number_format($filas ["ENGANCHE"], 2, '.', ',') ?></td>
              <td>$<?php echo number_format($filas ["LIQUIDACION"], 2, '.', ',') ?></td>
              <td>
                

                  <!-- Modificar reservaciones -->
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_RESERVACION'] ?>" onclick="Reservacion('<?php $filas['ID_RESERVACION'] ?>')" class="btn btn-warning btn-sm d-flex align-items-center" style="padding-y: 0.1rem; font-size: 0.6rem; color: black;" id="botonModificar">Modificar
                  <i class="fa fa-pencil-square-o ms-1" aria-hidden="true"></i></a><div class="mb-1"></div> <!--Salto de linea-->
                  <!-- Modal para modificar reservaciones-->
                  <div class="modal fade" id="exampleModal_<?php echo $filas['ID_RESERVACION'] ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar reservación de <?= $filas['NOMBRE_CLIENTE'] ?></h1>
                          <input id="Reservacion_<?php echo $filas['ID_RESERVACION'] ?>" name="Reservacion" value="" hidden>
                            <input type="hidden" name="idreservacion" id="idreservacion" value="<?php echo $filas['ID_RESERVACION'] ?>">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3"></div> <!--Salto de linea-->
                        <!--posponer reservaciones-->
                        <div class="modal-body">
                          <form action="../Controlador/controlador_posponer_reservacion.php" class="formulario row g-3 needs-validation" name="<?php echo $idForm; ?>" id="<?php echo $idForm; ?>" method="post" novalidate>
                            <div class="mb-3"></div> <!-- Salto de línea -->
                              <input type="hidden" name="id" value="<?= $filas['ID_RESERVACION'] ?>">
                              <input type="hidden" name="idsala" value="<?= $filas['ID_SALA'] ?>">
                            <div class="row">
                              <div class="col">
                                <label for="Fecha inicio">Fecha de inicio *</label>
                                <input type="date" class="form-control" name="Fechainicio" value="<?=$filas['FECHA_ENTRADA']?>" placeholder="Fecha de inicio" aria-label="Fecha  de inicio" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                              <div class="col">
                                <label for="Fecha finalizacion">Fecha de finalización *</label>
                                <input type="date" class="form-control" name="Fechafinalizacion" value="<?=$filas['FECHA_SALIDA']?>" placeholder="Fecha de finalizacion" aria-label="Fecha  de finalizacion" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                            </div>
                            <div class="mb-2"></div> <!--Salto de linea-->

                            <div class="row">
                              <div class="col">
                                <label for="Hora inicio">Hora de inicio *</label>
                                <input type="time" class="form-control" name="Horainicio" value="<?=$filas['HORA_ENTRADA']?>" placeholder="Hora de inicio" aria-label="Hora de inicio" aria-describedby="basic-addon1" required>
                                <div class="invalid-feedback">
                                Verifique los datos
                                </div>
                              </div>
                              <div class="col">
                                <label for="Hora finalizacion">Hora de finalización *</label>
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
                              <input type="hidden" name="enganche" value="<?= $filas['ENGANCHE'] ?>">
                              <label for="Abono">Abono *</label>
                              <input type="text" class="form-control" name="Abono" placeholder="Abono" aria-label="Abono" aria-describedby="basic-addon1" value=0 onblur="formatoMoneda(this)" required>
                              <div class="invalid-feedback">
                                Verifique los datos
                              </div>
                            </div>
                            <div class="col"><input type="hidden" name="Liquidacion" value="<?= $filas['LIQUIDACION'] ?>"></div>
                          </div>
                            <div class="mb-5"></div> <!--Salto de linea-->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Confirmar</button>
                              <button type="button" class="btn btn-secondary" onclick="limpiar('<?php echo $idForm?>')" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Boton para eliminar-->
                  <?php
                  // Se obtiene el id para realizar las consultas
                  $id_reservacion = $filas['ID_RESERVACION'];
                  $id_vis_res = $filas['ID_VISITA'];

                  $entVis = mysqli_query($conexion, "SELECT * FROM srcv_visitas WHERE ID_VISITA = $id_vis_res");
                  $EUS = mysqli_fetch_assoc($entVis);
                  if(empty($EUS["ENTRADA_URSPACE"]) && empty($EUS["SALIDA_URSPACE"])){
                  ?>
                  <a hhref="#" id="botonEliminar" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-danger btn-sm d-flex align-items-center" style="padding-y: 0.1rem; font-size: 0.6rem; color: black;">Cancelar
                  <i class="fa fa-times ms-1" aria-hidden="true"></i></a><div class="mb-1"></div><!--Salto de linea-->
                  <!-- Modal de confirmación-->
                  <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">¿Estás seguro de que deseas eliminar la reservación?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="../Controlador/controlador_eliminar_reservacion.php?id=<?=$filas['ID_RESERVACION']?>" id="botonCancelar" class="btn btn-primary">Aceptar</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }else{
                  }

                  $salidavisita = "SELECT SALIDA_URSPACE FROM srcv_visitas WHERE ID_VISITA = $id_vis_res";
                  $visitasale = mysqli_query($conexion, $salidavisita);
                  $fila_salida = mysqli_fetch_assoc($visitasale);
                  $salious=$fila_salida['SALIDA_URSPACE'];

                  $salida = $filas['HORA_SALIDA'];
                  date_default_timezone_set('America/Mexico_City');
                  $hora_actual = date("H:i:s");
                  if(!empty($fila_salida['SALIDA_URSPACE'])){ ?>
                  <a href="../Controlador/controlador_uso_reservacion.php?id=<?=$filas['ID_RESERVACION']?>" class="btn btn-success btn-sm d-flex align-items-center" style="padding-y: 0.1rem; font-size: 0.6rem; color: black;" id="botonUso">Finalizar
                    <i class="fa fa-check-square-o ms-1" aria-hidden="true"></i></a><div class="mb-1"></div><!--Salto de linea-->
                  <?php }?>
                  <?php

                  // Realizar consulta para obtener la información de la entrada
                  $query_entrada = "SELECT ENTRADA_URSPACE FROM srcv_visitas WHERE ID_VISITA = $id_vis_res";
                  $resultado_entrada = mysqli_query($conexion, $query_entrada);

                  if ($resultado_entrada) {
                      $fila_entrada = mysqli_fetch_assoc($resultado_entrada);
                      
                      // Verificar si la entrada está confirmada
                      if (!empty($fila_entrada['ENTRADA_URSPACE'])) {
                          // Si la entrada está confirmada solo se muestra el icono 
                          //echo '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                      } else {
                          // Si la entrada no está confirmada se habilita el enlace para confirmar la entrada 
                          echo '<a href="../Controlador/controlador_entrada_urspace.php?id=' . $id_vis_res . '" class="btn btn-info btn-sm d-flex align-items-center" style="padding-y: 0.1rem; font-size: 0.6rem; color: black;" id="botonEntrada">Entrada
                          <i class="fa fa-sign-in ms-1" aria-hidden="true"></i></a><div class="mb-1"></div><!--Salto de linea-->';
                      }
                  } else {
                      echo 'Error al confirmar la salida.';
                  }
                  ?>

                  <?php
                  // Se obtiene el id para poder hacer la consulta
                  $id_reservacion = $filas['ID_RESERVACION'];
                  $id_vis_res = $filas['ID_VISITA'];

                  // Realizar consulta para obtener la información de la salida
                  $query_salida = "SELECT SALIDA_URSPACE FROM srcv_visitas WHERE ID_VISITA = $id_vis_res";
                  $resultado_salida = mysqli_query($conexion, $query_salida);

                  if ($resultado_salida) {
                      $fila_salida = mysqli_fetch_assoc($resultado_salida);
                      // Verificar si la salida está confirmada
                      if (!empty($fila_salida['SALIDA_URSPACE']) || empty($fila_salida['SALIDA_URSPACE']) && $salida>$hora_actual) {
                        if($salida>$hora_actual){
                          //echo '<i class="fa fa-sign-out" aria-hidden="true"></i>';
                        }
                          // Si la salida está confirmada solo se muestra el icono 
                         // echo '<i class="fa fa-sign-out" aria-hidden="true"></i>';
                      } else {
                          // Si la salida no está confirmada se habilita el enlace para confirmar la salida 
                          echo '<a href="../Controlador/controlador_salida_urspace.php?id=' . $id_vis_res . '" class="btn btn-info btn-sm d-flex align-items-center" style="padding-y: 0.1rem; font-size: 0.6rem; color: black;" id="botonSalida">Salida
                          <i class="fa fa-sign-out ms-1" aria-hidden="true"></i></a>';
                      }
                  } else {
                      echo 'Error al confirmar la salida.';
                  }
                  ?>


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


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
<script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->
<script src="../js/validaciones_reservaciones.js"></script>

<script>
function formatoMoneda(input) {
    // Obtener el valor numérico ingresado
    let numero = parseFloat(input.value.replace(/[^\d.]/g, ''));

    // Verificar si es un número válido
    if (!isNaN(numero)) {
        // Formatear el número con separadores de miles y como moneda
        const formatoMoneda = numero.toLocaleString('es-MX', {
            style: 'currency',
            currency: 'MXN' // Cambiar a pesos mexicanos
        });
        
        // Actualizar el valor del campo de entrada con el formato de moneda
        input.value = formatoMoneda;
    }
}

// Aplicar formato de moneda nuevamente cuando se edita el campo
document.getElementById('total').addEventListener('input', function() {
    formatoMoneda(this);
});


  function Reservacion(idreservacion){
    document.getElementById('Reservacion_' + idreservacion).value = idreservacion;

    }
      //Limpiar fromulario
  function limpiar(idForm) {
      var formulario = document.getElementById(idForm);
      // Resetear el formulario
      formulario.reset();
    }
</script>
<script>
  // Crear tooltip para el botón 1
tippy('#botonModificar', {
        content: 'Modificar reservación',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonCancelar', {
        content: 'Cancelar',
        placement: 'bottom',
      });
// Crear tooltip para el botón 3
tippy('#botonUso', {
        content: 'Confirmar uso',
        placement: 'bottom',
      });
// Crear tooltip para el botón 4
tippy('#botonEntrada', {
        content: 'Confirmar entrada',
        placement: 'bottom',
      });
// Crear tooltip para el botón 5
tippy('#botonSalida', {
        content: 'Confirmar salida',
        placement: 'bottom',
      });



  //Script de buscador
  document.addEventListener('keyup', e =>{
    if(e.target.matches('#buscador')){
      document.querySelectorAll('.datos').forEach(dato =>{
        dato.textContent.toLowerCase().includes(e.target.value)
        ? dato.classList.remove('filtro')
        : dato.classList.add('filtro')
      }) 
    }
  })
  //fin del script de buscardor


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
      buttons: {
        cancel: "Cancelar",
        confirm: {
          text: "Aceptar",
          className: "botonconfirmar"
        }
      },
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Agrega un event listener para el envío del formulario
    document.querySelector('form').addEventListener('submit', function(event) {
        // Obtiene el valor del campo de abono
        var abono = parseFloat(document.querySelector('input[name="Abono"]').value);
        var horainicio = document.querySelector('input[name="Horainicio"]').value;
        var horafinalizacion = document.querySelector('input[name="Horafinalizacion"]').value;
        var fechainicio = document.querySelector('input[name="Fechainicio"]').value;
        var fechafinalizacion = document.querySelector('input[name="Fechafinalizacion"]').value;

        // Verifica si el abono es menor o igual a cero
        if ((abono) < 0) {
            // Muestra una alerta utilizando SweetAlert
            swal("Error", "La cantidad de abono no puede ser negativa.", "error");

            // Evita que el formulario se envíe
            event.preventDefault();
        }else {
             // Verificar si las fechas y horas son válidas
            var fechaInicio = new Date(fechainicio + 'T' + horainicio);
            var fechaFinalizacion = new Date(fechafinalizacion + 'T' + horafinalizacion);

            if (fechaFinalizacion <= fechaInicio) {
                valid = false;
                swal('Error', 'Verifique los datos del horario de reservación.', 'error');
                event.preventDefault();
            }
        }
    });
});
</script>
</body>
</html>