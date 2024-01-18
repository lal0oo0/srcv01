<?php
session_start();
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

  .Titulo{
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
<nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV RH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title Titulo" id="offcanvasDarkNavbarLabel">Menú</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="vista_registro_administradores.php">Administradores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="vista_registro_categorias.php">Categorías</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/controlador_cerrar_sesion.php">Cerrar Sesión</a>
          </li>
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
<h3 class="text-center">LISTA DE CATEGORÍAS</h3>
<div class="mb-5"></div> <!--Salto de linea-->
<div class="container caja">
  <div class="row">
    <div class="col-md-12">
        <label for="Nombre" class="col-form-label">Registro de una nueva categoría</label>
    </div>
  </div>
</div>

<div class="container caja2">
  <div class="row">
    <div class="col-md-12">
      <form action="../Controlador/controlador_registro_categoria.php" class="formulario needs-validation" method="post" novalidate>
        <div class="row g-3 align-items-center">
          <div class="col-md-2">
          <label for="Nombre" class="col-form-label">Nombre de la categoría:</label>
          </div>
          <div class="col-md-6">
          <input type="text" class="form-control" name="Nombre" placeholder="Ingresa el nombre de la categoría" aria-label="Nombre" aria-describedby="basic-addon1" required>
          </div>
          <div class="col-md-3">
          <select class="form-select" name="Categoria" id="validationCustom04" required>
            <option selected value="" >Selecciona la categoría</option>
            <option value="Empresa">Empresa</option>
            <option value="Asunto">Asunto</option>
          </select>
          </div>
          <div class="col-md-1">
          <button type="submit" class="btn btn-danger">AGREGAR</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
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
          <tr>
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
            <a href="../Controlador/controlador_activar_categorias.php?id=<?=$filas['ID_LISTA']?>"><i class="fa fa-check" aria-hidden="true"></i></a>
            <a href="../Controlador/controlador_desactivar_categorias.php?id=<?=$filas['ID_LISTA']?>"><i class="fa fa-times" aria-hidden="true"></i></a>
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

</body>
</html>