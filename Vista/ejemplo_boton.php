<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
session_start();
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
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

  #boton {
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
            <a class="nav-link" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesión</a>
          </li>
      </div>
    </div>
  </div>
</nav>
</header>
<br><br><br><br><br>
<h3 class="text-center">EJEMPLO DE BOTON</h3> 
<div class="mb-5"></div> <!--Salto de linea-->

<div class="container">

  <!--Bucador-->
  
  <input type="text" id="texto" oninput="mostrarBoton()">

  <button id="boton">Enviar</button>

  <script>
    function mostrarBoton() {
      var texto = document.getElementById("texto").value;
      var boton = document.getElementById("boton");

      if (texto.trim() !== "") {
        boton.style.display = "block";
      } else {
        boton.style.display = "none";
      }
    }
  </script>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>



</body>
</html>