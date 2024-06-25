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
require_once("../Modelo/conexion2.php");
$conexion = conect();
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
    
    <title>Historial de visistas administrador</title>
</head>
<style>

   .navbar-custom {
    background-color: #64BAFF; /* Darle color al NAV, del color que se necesite */
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

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
    background-color: #F32B2B;
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

  .titulo{
    color: white;
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
    $query = mysqli_query ($conexion, "SELECT * FROM srcv_visitas ORDER BY FECHA DESC, ENTRADA_SEGURIDAD DESC");
    $queryempresa = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE CATEGORIA='empresa' and ESTATUS='1'");
    $queryasunto = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE CATEGORIA='asunto' and ESTATUS='1'");
?>
 
<header>
<nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV RH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title titulo" id="offcanvasDarkNavbarLabel">Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="vista_registro_administradores.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_registro_categorias.php">Categorías</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="vista_historial_visitas_administrador.php">Historial visitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_reservaciones_admin.php">Historial reservaciones</a>
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
<h3 class="text-center">HISTORIAL DE VISITAS</h3> 
<div class="mb-5"></div> <!--Salto de linea-->

<div class="container">

  <!--Bucador-->
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
    </div>
  </div>
  <div class="mb-3"></div><!--Salto de linea-->

  <div class="mb-3"></div><!--Salto de linea-->
    <!-- ALERTA -->
    <div class="mb-4"></div><!--Salto de linea-->
    <div id="mensaje">
      <?php echo $mensaje; ?>
    </div>
  <div class="mb-3"></div><!--Salto de linea-->

  <div class="row">
    <div class="col-*-*">
      <div class="table-responsive my-custom-scrollbar">
        <!-- Estos son datos de ejemplo -->
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Fecha</th>
                <th scope="col">Empresa</th>
                <th scope="col">Asunto</th>
                <th scope="col">Entrada Seguridad</th>
                <th scope="col">Entrada Recepción</th>
                <th scope="col">Entrada UrSpace</th>
                <th scope="col">Salida UrSpace</th>
                <th scope="col">Salida Recepción</th>
                <th scope="col">Salida Seguridad</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while ($filas = mysqli_fetch_assoc($query)) {
            ?>
            <tr class="datos">
                <td><?php  
                if($filas['ERROR_SALIDA']==1){
                  echo '<i class="fa fa-exclamation-triangle" aria-hidden="true" id="advertencia" style="font-size: 12px"></i> ';
                }else{echo '';}
                echo $filas['NOMBRE'];
                ?></td>
                <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                <td><?php echo $filas['FECHA'] ?></td>
                <td><?php echo $filas['EMPRESA'] ?></td>
                <td><?php echo $filas['ASUNTO'] ?></td>
                <td><?php echo $filas['ENTRADA_SEGURIDAD'] ?></td>
                <td><?php echo $filas['ENTRADA_RECEPCION'] ?></td>
                <td><?php echo $filas['ENTRADA_URSPACE'] ?></td>
                <td><?php echo $filas['SALIDA_URSPACE'] ?></td>
                <td><?php echo $filas['SALIDA_RECEPCION'] ?></td>
                <td>
                  <?php
                  if(!$filas["ERROR_SALIDA"]){
                  echo $filas['SALIDA_SEGURIDAD'];
                  }
                  else{
                    echo $filas['SALIDA_SEGURIDAD'];
                    ?>
                    <a href="../Controlador/controlador_borrar_salida.php?id=<?=$filas['ID_VISITA']?>" class="btn btn-light btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black; border-color: #000000">Borrar salida 
                    <i class="fa fa-trash" aria-hidden="true" id="advertencia" style="font-size: 12px"></i></a>
                  <?php
                  } 
                  ?>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
      </div>
    </div> 
  </div>
</div>
<div class="mb-3"></div><!--Salto de linea-->

<div class="mb-4"></div> 
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-4"></div>
    <div class="col-sm-12 col-md-8 highlight-container">
      <form action="../PhpSpreadsheet/reporte_visitas.php" method="post">
        <div class="row">
          <div class="col-sm-3">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
          </div>
          <div class="col-sm-3">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
          </div>
          
          <div class="col-sm-2">
            <label class="form-label" for="empresa">Empresa</label><br>
            <select class="form-select mr-sm-2" id="empresa" name="empresa">
              <option selected value="">Elige</option>
              <!--Se muestran las opciones de EMPRESA previamente registradas en la tabla listas-->
              <?php
                while ($filas = mysqli_fetch_assoc($queryempresa)) {
              ?>
              <option value="<?php echo $filas['NOMBRE']; ?>">
                <?php echo $filas['NOMBRE']; ?>
              </option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="asunto">Asunto</label><br>
            <select class="form-select mr-sm-2" id="asunto" name="asunto">
              <option selected value="">Elige</option>
              <!--Se muestran las opciones de ASUNTO previamente registradas en la tabla listas-->
              <?php
                while ($filas = mysqli_fetch_assoc($queryasunto)) {
              ?>
              <option value="<?php echo $filas['NOMBRE']; ?>">
                <?php echo $filas['NOMBRE']; ?>
              </option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="col-sm-2 d-flex align-items-center justify-content-center"> <!-- Modificado para centrar el botón verticalmente -->
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>

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
//Fin del  scripyt
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