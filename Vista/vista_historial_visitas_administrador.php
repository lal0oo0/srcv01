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
  height: 400px;
  overflow: auto;
  }
  .table-wrapper-scroll-y {
  display: block;
  }

  .titulo{
    color: white;
  }

  .filtro{
    display: none;
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_visitas");
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
            <a class="nav-link" href="vista_registro_administradores.php">Administradores</a>
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
                <td><?php echo $filas['NOMBRE'] ?></td>
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
                <td><?php echo $filas['SALIDA_SEGURIDAD'] ?></td>
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
<div class="mb-1"></div> 
<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-6 shadow p-3 mb-5 bg-body-tertiary rounded">
    <form action="../PhpSpreadsheet/reporte_administracion.php" method="post">
      <label for="fecha_inicio">Fecha de inicio:</label>
      <input type="date" id="fecha_inicio" name="fecha_inicio">

      <label for="fecha_fin">Fecha de fin:</label>
      <input type="date" id="fecha_fin" name="fecha_fin">
      
      <button type="submit" class="btn btn-dark tit-color" style="background-color:#008000">
        <img src="../imagenes/excel.png" width="20px">Informe
      </button>
    </form>
  </div>
  <div class="col-md-1"></div>
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