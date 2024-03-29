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
  height: 350px;
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

  .filtro {
    background-color: rgba(255, 0, 0, 0.2); /* Puedes ajustar este color a tu preferencia */
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
            <a class="nav-link" aria-current="page" href="vista_mapa_espacios.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="vista_reservaciones_urspace.php">Reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" aria-current="page" href="vista_registro_espacios.php">Registro de espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
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
<br><br><br>
<div class="mb-5"></div> <!--Salto de linea-->
<h3 class="text-center">HISTORIAL DE RESERVACIONES</h3>
<div class="mb-5"></div>

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
      <div class="table_responsive my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nombre del cliente</th>
              <th scope="col">Apellido paterno</th>
              <th scope="col">Apellido Materno</th>
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
            </tr>
          </thead>
          <?php
              require_once("../Modelo/conexion2.php");
              $conexion = conect();
              $query = mysqli_query ($conexion, "select * from srcv_reservaciones");
              while($filas  = mysqli_fetch_assoc($query)){
          ?>
          <tr class="datos">
              <td><?php echo$filas ["NOMBRE_CLIENTE"] ?></td>
              <td><?php echo$filas ["APELLIDO_PATERNO"] ?></td>
              <td><?php echo$filas ["APELLIDO_MATERNO"] ?></td>
              <td><?php echo$filas ["NOMBRE_ESPACIO"] ?></td>
              <td><?php echo$filas ["CORREO_ELECTRONICO"] ?></td>
              <td><?php echo$filas ["TELEFONO"] ?></td>
              <td><?php echo$filas ["FECHA_ENTRADA"] ?></td>
              <td><?php echo$filas ["FECHA_SALIDA"] ?></td>
              <td><?php echo$filas ["HORA_ENTRADA"] ?></td>
              <td><?php echo$filas ["HORA_SALIDA"] ?></td>
              <td><?php echo$filas ["NUMERO_PERSONAS"] ?></td>
              <td><?php echo$filas ["SERVICIOS_EXTRA"] ?></td>
              <td>$<?php echo$filas ["TOTAL"] ?></td>
              <td>$<?php echo$filas ["ENGANCHE"] ?></td>
              <td>$<?php echo$filas ["LIQUIDACION"] ?></td>
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
<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-11 d-flex justify-content-end">
  <form id="form-descargar" action="../PhpSpreadsheet/reporte_urspace.php" method="post">
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
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
<script>
  //Script de buscador
  document.addEventListener('keyup', e =>{
    if(e.target.matches('#buscador')){
      var searchText = e.target.value.toLowerCase();
      document.querySelectorAll('.datos').forEach(dato =>{
        var matchFound = false;
        dato.querySelectorAll('td').forEach(cell => {
          if(cell.textContent.toLowerCase().includes(searchText)) {
            matchFound = true;
          }
        });
        if(matchFound) {
          dato.classList.remove('filtro');
        } else {
          dato.classList.add('filtro');
        }
      });
    }
  });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
        // Evento cuando se hace clic en el botón de descarga
        document.getElementById('form-descargar').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

            // Crear una nueva instancia de XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud AJAX
            xhr.open('POST', '../PhpSpreadsheet/ejemploreporteurpace.php', true);
            xhr.responseType = 'blob'; // Tipo de respuesta esperada

            // Cuando la solicitud AJAX se complete
            xhr.onload = function(e) {
                if (this.status === 200) {
                    // Crea un objeto Blob con la respuesta
                    var blobResponse = this.response;

                    // Crear un objeto URL para el Blob
                    var url = window.URL.createObjectURL(blobResponse);

                    // Crear un enlace <a> para descargar el archivo Excel
                    var a = document.createElement("a");
                    document.body.appendChild(a);
                    a.href = url;
                    a.download = "reservaciones.xlsx";

                    // Hacer clic en el enlace para descargar el archivo
                    a.click();

                    // Liberar el objeto URL
                    window.URL.revokeObjectURL(url);
                }
            };

            // Obtener los datos del formulario de búsqueda
            var formData = new FormData();
            formData.append('buscador', document.getElementById('buscador').value);

            // Enviar la solicitud AJAX con los datos del formulario
            xhr.send(formData);
        });
    });
    </script>
</body>
</html>