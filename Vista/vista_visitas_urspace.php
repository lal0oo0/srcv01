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
    <title>Visitas</title>
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

  .highlight-container {/* Estilos para resaltar el contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Agrega una sombra al contenedor */
    padding: 15px; /* Añade un relleno al contenedor para separarlo visualmente */
    margin-bottom: 20px; /* Agrega un margen inferior al contenedor */
  }

  .tit-color{
    color:white;
  }

  .filtro{
    display: none;
  }

</style>
<body>
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
            <a class="nav-link" aria-current="page" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="vista_visitas_urspace.php">Visitas</a>
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
<br><br><br>
<div class="mb-5"></div> <!--Salto de linea-->
<h3 class="text-center">VISITAS</h3>
<div class="mb-5"></div>

<div class="container">

<!--buscador-->
<form action="../PhpSpreadsheet/reporte_administracion.php" method="post">
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
    </div>
  </div>
</form>

  <div class="mb-3"></div><!--Salto de linea-->
      <!-- ALERTA -->
      <div class="mb-4"></div><!--Salto de linea-->
      <div id="mensaje">
        <?php echo $mensaje; ?>
      </div>
      <div class="mb-3"></div><!--Salto de linea-->

  <div class="row">
    <div class="col">
      <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
            <th scope="col">Hora de entrada</th>
            <th scope="col">Fecha</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Asunto</th>
            <th scope="col">Hora de salida</th>
            <th scope="col">Motivo</th>
            </tr>
          </thead>
          <?php
              require_once("../Modelo/conexion2.php");
              $conexion = conect();
              $query = mysqli_query ($conexion, "SELECT * FROM srcv_visitas WHERE ASUNTO <> 'Reservacion' AND EMPRESA='UrSpace'");
              while($filas  = mysqli_fetch_assoc($query)){
          ?>
          <tr class="datos">
                    <td>
                        <?php if(empty($filas['ENTRADA_URSPACE'])){ ?>
                        <a href="../Controlador/controlador_entrada_visitas_urspace.php?id=<?=$filas['ID_VISITA']?>" id="botonEntrada"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        <?php
                        }else{
                        echo $filas['ENTRADA_URSPACE'];
                        }?>
                    </td>
                    <td><?php echo $filas['FECHA'] ?></td>
                    <td><?php echo $filas['NOMBRE'] ?></td>
                    <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                    <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                    <td><?php echo $filas['ASUNTO'] ?></td>
                    <td>
                        <?php 
                        if(empty($filas['ENTRADA_URSPACE'])){
                          echo '';
                        } else{
                        if(empty($filas['SALIDA_URSPACE'])){ ?>
                        <a href="../Controlador/controlador_salida_visitas_urspace.php?id=<?=$filas['ID_VISITA']?>" id="botonSalida"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        <?php
                        }else{
                        echo $filas['SALIDA_URSPACE'];
                        }
                        }
                        ?>
                    </td>
                    <td>
                      <?php
                      if(empty($filas['MOTIVO'])){
                        ?>
                        
                  <!-- Modificar reservaciones -->
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_VISITA'] ?>" onclick="VISITA('<?php $filas['ID_VISITA'] ?>')" class="link-danger" id="botonMotivo"> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                  <!-- Modal para modificar reservaciones-->
                  <div class="modal fade" id="exampleModal_<?php echo $filas['ID_VISITA'] ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Motivo de visita de <?= $filas['NOMBRE'] ?></h1>
                          <input id="Visita_<?php echo $filas['ID_VISITA'] ?>" name="idvisita" value="" hidden>
                            <input type="hidden" name="idvisita" id="idvisita" value="<?php echo $filas['ID_VISITA'] ?>">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3"></div> <!--Salto de linea-->
                        <!--posponer reservaciones-->
                        <div class="modal-body">
                          <form action="../Controlador/controlador_motivo.php" class="formulario row g-3 needs-validation" method="post" novalidate>
                            <div class="mb-3"></div> <!-- Salto de línea -->
                              <input type="hidden" name="id" value="<?= $filas['ID_VISITA'] ?>">

                          <div class="row">
                            <div class= "col"></div>
                            <div class="col-8">

                              <label for="Abono">Escriba el motivo de la visita o la persona con quien se dirige</label>
                              <div class="mb-3"></div>
                              <input type="text" class="form-control" name="motivo" placeholder="Motivo" aria-label="Motivo" aria-describedby="basic-addon1" required>
                              <div class="invalid-feedback">
                                Verifique los datos
                              </div>
                              <div class="col"></div>
                            </div>
                            <div class="col">
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
                      }else{
                        echo $filas['MOTIVO'];
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
<div class="mb-4"></div> 
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-5"></div>
    <div class="col-sm-12 col-md-7 highlight-container">
      <form action="../PhpSpreadsheet/reporte_visitas.php" method="post">
        <div class="row">
          <div class="col-sm-4">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
          </div>
          <div class="col-sm-4">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
          </div>
          <div class="col-sm-4 d-flex align-items-center justify-content-center"> <!-- Modificado para centrar el botón verticalmente -->
            <button type="submit" class="btn btn-dark tit-color" style="background-color:#008000; width: 150px;"> <!-- Ajusta el ancho del botón según tus necesidades -->
              <img src="../imagenes/excel.png" width="20px">Informe
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="mb-2"></div>  


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
<script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->


<script>
  // Crear tooltip para el botón 1
tippy('#botonEntrada', {
        content: 'Confirmar entrada',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonSalida', {
        content: 'Confirmar salida',
        placement: 'bottom',
      });
// Crear tooltip para el botón 3
tippy('#botonMotivo', {
        content: 'Agregar motivo',
        placement: 'bottom',
      });
</script>


<script>
  function VISITA(idvisita){
    document.getElementById('Visita_' + idvisita).value = idvisita;

    }
</script>
<script>
  // Script de buscador en tiempo real por nombre, apellidos y fecha
  document.addEventListener('keyup', e => {
    if (e.target.matches('#buscador')) {
      const textoBusqueda = e.target.value.toLowerCase();
      document.querySelectorAll('.datos').forEach(dato => {
        const nombre = dato.children[2].textContent.toLowerCase();
        const apellidoPaterno = dato.children[3].textContent.toLowerCase();
        const apellidoMaterno = dato.children[4].textContent.toLowerCase();
        const fecha = dato.children[1].textContent.toLowerCase();
        
        if (nombre.includes(textoBusqueda) || 
            apellidoPaterno.includes(textoBusqueda) || 
            apellidoMaterno.includes(textoBusqueda) || 
            fecha.includes(textoBusqueda)) {
          dato.classList.remove('filtro');
        } else {
          dato.classList.add('filtro');
        }
      });
    }
  });

  //fin del script de buscardor

  //Script para mostrar alertas por determinado tiempo 
  document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el elemento de alerta
        var alerta = document.querySelector('.alert');

        // Verifica si se encontró el elemento de alerta
        if(alerta) {
            // Temporizador para eliminar la alerta después de 5 segundos (5000 milisegundos)
            setTimeout(function() {
                alerta.remove(); // Elimina la alerta del DOM
            }, 5000);
        }
    });
//Fin del  script
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