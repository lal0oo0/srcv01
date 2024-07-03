<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}

$ROL=$_SESSION['rol'];
// Verificar el rol del usuario
if ($ROL !== "administrador") {
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

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 300px;
  overflow: auto;
  }

  .table-wrapper-scroll-y {
  display: block;
  }

  .navbar-custom{
    background-color: #64BAFF; 
    font-size: 18px;
  }

.highlight-container {/* Estilos para resaltar el contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Agrega una sombra al contenedor */
    padding: 15px; /* Añade un relleno al contenedor para separarlo visualmente */
    margin-bottom: 20px; /* Agrega un margen inferior al contenedor */
  }

  .Titulo{
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
<nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV RH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title Titulo" id="offcanvasDarkNavbarLabel">Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="vista_registro_administradores.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="vista_registro_categorias.php">Categorías</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_visitas_administrador.php">Historial visitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_reservaciones_admin.php">Historial reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_configuracion_correo.php">Configuracion de correo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesión</a>
          </li>
      </div>
    </div>
  </div>
</nav>
</header>
<br><br><br><br><br>
<h3 class="text-center">LISTA DE CATEGORÍAS</h3>
<div class="mb-5"></div> <!--Salto de linea-->

<div class="container">
    <!--Bucador-->
    <div class="row">
      <div class="col-md-9"></div>
      <div class="col-md-3">
      <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
      </div>
    </div>
  <div class="mb-2"></div>
   <div class="row">
    <div class="col">
    </div>
  </div>
</div>
<div class="mb-2"></div> <!--Salto de linea-->

<div class="container highlight-container">
  <div class="row">
    <div class="col-12">
      <label for="Nombre" class="form-label">Registro de una nueva categoría</label>
    </div>
  </div>
  <div class="mb-3"></div> <!--Salto de linea-->

  <div class="row">
    <div class="col-12">
      <form action="../Controlador/controlador_registro_categoria.php" class="formulario needs-validation" method="post" novalidate>
        <div class="row g-3 align-items-center">
          <div class="col-sm-12 col-md-3">
            <label for="Nombre" class="form-label">Ingrese el nombre:</label>
          </div>
          <div class="col-sm-12 col-md-4">
            <input type="text" class="form-control" name="Nombre" placeholder="Ingrese el nombre" required>
          </div>
          <div class="col-sm-12 col-md-3">
            <select class="form-select" name="Categoria" required>
              <option selected value="">Selecciona la categoría</option>
              <option value="Empresa">Empresa</option>
              <option value="Asunto">Asunto</option>
              <option value="Piso">Piso</option>
              <option value="Correo">Correo</option>
            </select>
          </div>
          <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn btn-sm btn-danger w-auto w-md-100">AGREGAR</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="mb-2"></div> <!--Salto de linea-->

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" id="mensaje">
    <?php echo $mensaje; ?>
  </div>
  <div class="col md-1"></div>
</div>
<div class="mb-2"></div><!--Salto de linea-->

<div class="container">

  <div class="mb-2"></div>
  <div class="row">
    <div class="col">
      <div class="table-responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Categoría</th>
              <th scope="col">Estatus</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "select * from srcv_listas");
                  
            while($filas  = mysqli_fetch_assoc($query)){
          ?>
          <tr class="datos">
            <td><?php echo$filas ["NOMBRE"] ?></td>
            <td><?php echo$filas ["CATEGORIA"] ?></td>
            <td><?php
            if($filas["ESTATUS"]==='0'){
            $filas["ESTATUS"]='Inactivo';
            }elseif($filas['ESTATUS']==='1'){
            $filas["ESTATUS"]='Activo';
            }
            echo$filas["ESTATUS"];
            ?></td>
           <td>
            <?php
            if($filas["ESTATUS"]==='Inactivo'){
            ?>
            <a href="../Controlador/controlador_activar_categorias.php?id=<?=$filas['ID_LISTA']?>" id="botonActivar"
            class="btn btn-success btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;">
            Activar
            <i class="fa fa-check" aria-hidden="true"style="font-size: 12px;"></i>
            </a>
            <?php
            }elseif($filas["ESTATUS"]==='Activo'){
            ?>
            <a href="../Controlador/controlador_desactivar_categorias.php?id=<?=$filas['ID_LISTA']?>" id="botonDesactivar"
            class="btn btn-danger btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;">
            Desactivar
            <i class="fa fa-times" aria-hidden="true" style="font-size: 12px;"></i>
            </a>
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
  </div>
</div>
<br>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
  <script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->


<script>
  // Crear tooltip para el botón 1
tippy('#botonActivar', {
        content: 'Activar categoría',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonDesactivar', {
        content: 'Desactivar categoría',
        placement: 'bottom',
      });
</script>

<script>
//VALIDACIONES
// Example starter JavaScript for disabling form submissions if there are invalid fields
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
//Fin del script



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
//Fin del script



//ALERTAS
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
                        text: 'La categoría se encuentra registrada exitosamente!',
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