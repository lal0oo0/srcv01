<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Registros de salas</title>
</head>

<style>
.navbar-custom {
    background-color: #F73B3B; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
    background-color: #F32B2B;
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 300px;
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
    height: 70px;
  }

  .caja2{
    border: 1px solid #B0ADAD;
    padding: 20px;
    height: 90px
  }
</style>

<header>
<nav class="navbar navbar-dark  fixed-top navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img id="logo" src="../imagenes/Logo-Urspace.png" width="95">SRCV SALAS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="vista_mapa_salas.php">Mapa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="vista_registro_salas.php">Registro de salas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_reservaciones.php">Historial de reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cerrar Aplicacion</a>
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
<h3><center>LISTA DE SALAS</center></h3>
<br>

  <div class="container">
    <div class="row">
      <div class="col">
      <div class="table-responsive my-custom-scrollbar">
      <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre de la Sala</th>
            <th scope="col">Estatus</th>
          </tr>
        </thead>
        <?php
          require_once("../Modelo/conexion2.php");
          $conexion = conect();
          $query = mysqli_query ($conexion, "select * from srcv_salas WHERE ESTATUS = 1");
          while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
          <td><?php echo$filas ["ID_SALA"] ?></td>
          <td><?php echo$filas ["NOMBRE"] ?></td>
          <td><?php echo$filas ["ESTATUS"] ?></td>
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
  <br>

  <div class="mb-3"></div> <!--Salto de linea-->
  <div class="container caja">
    <div class="row">
      <div class="col-md-12">
      <label for="Nombre" class="col-form-label">Registar una nueva sala</label>
      </div>
    </div>
  </div>

  <div class="container caja2">
    <div class="row">
      <div class="col-md-12">
        <form action="../Controlador/controlador_registro_salas.php" class="formulario" method="post">
          <div class="row g-3 align-items-center">
            <div class="col-md-2">
            <label for="Nombre" class="col-form-label">Nombre de la sala:</label>
            </div>
            <div class="col-md-6">
            <input type="text" class="form-control" name="Nombre" placeholder="Ingresa el nombre de la sala" aria-label="Nombre" aria-describedby="basic-addon1">
            </div>
            <div class="col-md-1">
            <button type="submit" class="btn btn-danger">AGREGAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


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
                        title: 'Good job!',
                        text: 'You clicked the button!',
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

</body>
</html>