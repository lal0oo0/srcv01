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
    <title>Envío de Promociones</title>
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

  .highlight-container {/* Estilos para resaltar el contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Agrega una sombra al contenedor */
    padding: 15px; /* Añade un relleno al contenedor para separarlo visualmente */
    margin-bottom: 20px; /* Agrega un margen inferior al contenedor */
  }
  
  .filtro{
    display: none;
  }

  .botonconfirmar {
    background-color: #007bff; /*color boton de cerrar sesion */
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
<h3 class="text-center">PROMOCIONES</h3> 

<!--Registrar nueva sala-->
<div class="mb-5"></div> <!--Salto de linea-->

<div class="container">
  <div class="row">
    <div class="mb-4"></div>
   <!--Bucador-->
    <div class="col-md-3">
    <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
    </div>
    <div class="col-md-7">
    </div> 
    <div class="col-md-2">
     <button class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nueva Promoción</button >
    </div> 

    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Promoción</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="card-body">
            
            <form action="../Controlador/controlador_registrar_promos.php" method="POST" class="row g-3 needs-validation" name="myForm" id="myForm" enctype="multipart/form-data" novalidate>
            
            <div class="col-md-12">
              <label for="nombre" class="form-label">Nombre de la promoción *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="nombre" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>

            <h6 class="text-center">Datos del correo</h6>
            <div class="col-md-12">
              <label for="asunto" class="form-label">Asunto del correo *</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="asunto" id="asunto" required>
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
              <div class="mb-3"></div> <!--Salto de linea-->
              <div class="col-md-12">
              <label for="encabezado" class="form-label">Encabezado *</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="encabezado" id="encabezado" required>
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
              <div class="mb-3"></div> <!--Salto de linea-->
                <div class="col-md-12">
                <label for="file" class="form-label">Elija una imagen</label>
                <input class="form-control" style="border: 2px solid #1E90FF;" type="file" accept="image/jpeg" name= "file[]" id="file">
                </div>
                <div class="mb-3"></div> <!--Salto de linea-->
              <label for="cuerpo" class="form-label">Cuerpo</label>
              <div class="input-group has-validation">
                <textarea class="form-control" name="cuerpo" id="cuerpo" style="border: 2px solid #1E90FF;" aria-label="With textarea"></textarea>
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
              <div class="mb-3"></div> <!--Salto de linea-->
              <label for="foot" class="form-label">Pie de página *</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="foot" id="foot" required>
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
            </div>


            </div>
            <br>

            <br>
            <div class="col-12">
              <input type="submit" value="Guardar" class="btn btn-primary" name="Guardar"></button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
            </div>
            </form>
          </div>

      </div>

    </div>
  </div>
</div>
<!--FIN DEL MODAL-->

  </div>
</div>
<div class="mb-2"></div> <!--Salto de linea-->



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
      <div class="col-md-4 highlight-container">
      <div class="table-responsive my-custom-scrollbar">
      <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col">Nombre cliente</th>
            <th scope="col">Correo</th>
            <th scope="col">Enviar</th>
          </tr>
        </thead>
        <?php
          require_once("../Modelo/conexion2.php");
          $conexion = conect();
          $query = mysqli_query ($conexion, "SELECT DISTINCT CORREO_ELECTRONICO, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, PROMOCIONES, ESTATUS FROM srcv_reservaciones WHERE PROMOCIONES = '1'");
          while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr class="datos">
          <td><?php echo$filas ["NOMBRE_CLIENTE"] . ' ' . $filas['APELLIDO_PATERNO'] . ' ' . $filas['APELLIDO_MATERNO'] ?></td>
          <td><?php echo$filas ["CORREO_ELECTRONICO"] ?></td>
          <td><?php
          if($filas["ESTATUS"]==='0'){
          $filas["ESTATUS"]='Inactivo';
          }elseif($filas['ESTATUS']==='1'){
          $filas["ESTATUS"]='Activo';
          }
          ?>
            <?php
            if($filas["ESTATUS"]=='Inactivo'){
            ?>
            <a href="../Controlador/controlador_activar_espacio.php" class="btn btn-success btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;" id="botonActivar">Si
            <i class="fa fa-check" aria-hidden="true" style="font-size: 12px;"></i></a>
            <?php
            }elseif($filas["ESTATUS"]=='Activo'){
            ?>
            <a href="../Controlador/controlador_desactivar_espacio.php" class="btn btn-danger btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;" id="botonDesactivar">No
            <i class="fa fa-times" aria-hidden="true" style="font-size: 12px;"></i></a>
            <?php
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

        <div class="col highlight-container">
        <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Promoción</th>
              <th scope="col">Estatus</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "SELECT * FROM srcv_promociones WHERE ESTATUS = '1'");
            while($filas  = mysqli_fetch_assoc($query)){
          ?>
          <tr class="datos">
            <td><?php echo$filas ["NOMBRE_PROMOCION"]?></td>
            <td><?php
            if($filas["ESTATUS"]==='0'){
            $filas["ESTATUS"]='Inactivo';
            }elseif($filas['ESTATUS']==='1'){
            $filas["ESTATUS"]='Activo';
            }
          echo$filas["ESTATUS"];
            ?></td>
            <td>
              <button class="btn btn-info btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;" id="botonActivar" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo$filas['ID_PROMOCION'];?>">Ver
              <i class="fa fa-eye" aria-hidden="true" style="font-size: 12px;"></i></button>
              <div class="modal fade" id="exampleModal_<?php echo$filas['ID_PROMOCION'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">
                      <?php
                      echo $filas['NOMBRE_PROMOCION'];
                      ?>
                      </h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      echo '
                                  <form action="../Controlador/controlador_editar_promos.php" method="POST" class="row g-3 needs-validation" name="myForm2" id="myForm" novalidate>
            
                                  <div class="col-md-12">
                                    <label for="nombre" class="form-label">Nombre de la promoción *</label>
                                    <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="nombre" value="'. $filas['NOMBRE_PROMOCION'] .'" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required>
                                    <div class="invalid-feedback">
                                    Ingrese informacion valida.
                                    </div>
                                  </div>

                                  <h6 class="text-center">Datos del correo</h6>
                                  <div class="col-md-12">
                                    <label for="asunto" class="form-label">Asunto del correo *</label>
                                    <div class="input-group has-validation">
                                      <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="asunto" id="asunto" value="'. $filas['ASUNTO'] .'"  required>
                                      <div class="invalid-feedback">
                                      Ingrese informacion valida.
                                      </div>
                                    </div>
                                    <div class="mb-3"></div> <!--Salto de linea-->
                                    <div class="col-md-12">
                                    <label for="encabezado" class="form-label">Encabezado *</label>
                                    <div class="input-group has-validation">
                                      <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="encabezado" id="encabezado" value="'. $filas['ENCABEZADO'] .'" required>
                                      <div class="invalid-feedback">
                                      Ingrese informacion valida.
                                      </div>
                                    </div>
                                    <div class="mb-3"></div> <!--Salto de linea-->
                                      <div class="col-md-12">
                                      <label for="file" class="form-label">Elija una imagen</label>
                                      <input class="form-control" style="border: 2px solid #1E90FF;" type="file" id="file2">
                                      </div>
                                      <div class="mb-3"></div> <!--Salto de linea-->
                                    <label for="cuerpo" class="form-label">Cuerpo</label>
                                    <div class="input-group has-validation">
                                      <textarea class="form-control" name="cuerpo" id="cuerpo" style="border: 2px solid #1E90FF;" aria-label="With textarea">'. $filas['CUERPO'] .'</textarea>
                                      <div class="invalid-feedback">
                                      Ingrese informacion valida.
                                      </div>
                                    </div>
                                    <div class="mb-3"></div> <!--Salto de linea-->
                                    <label for="foot" class="form-label">Pie de página *</label>
                                    <div class="input-group has-validation">
                                      <input type="text" class="form-control" style="border: 2px solid #1E90FF;" value="'. $filas['PIE_PAGINA'] .'" name="foot" id="foot" required>
                                      <div class="invalid-feedback">
                                      Ingrese informacion valida.
                                      </div>
                                    </div>
                                  </div>


                                  </div>
                                  <br>

                                  <br>
                                  <div class="col-12">
                                    <input type="submit" value="Guardar" class="btn btn-primary" name="Guardar"></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
                                  </div>
                                  </form>
                      ';
                      ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
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
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
<script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->


<script>
  // Crear tooltip para el botón 1
tippy('#botonActivar', {
        content: 'Enviar promoción',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonDesactivar', {
        content: 'No enviar promoción',
        placement: 'bottom',
      });
</script>

<script>
// Espera a que el documento HTML esté completamente cargado antes de ejecutar el script
$(document).ready(function() {
    // Captura el evento de envío del formulario con la clase 'formulario'
    $("#myForm").submit(function(e) {
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
</body>
</html>