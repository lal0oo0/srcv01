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
    <title>Agregar Usuarios</title>
</head>

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
  height: 350px;
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
</style>
<header>
<nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/logo_it.png" width="60px"> SRCV Registros</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title Titulo" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" href="vista_registro_categorias.php">Categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../Controlador/controlador_cerrar_sesion.php">Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Cerrar Aplicacion</a>
          </li>
        </ul>
        </ul>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="Buscar" placeholder="Buscar" aria-label="Buscar">
          <button class="btn btn-success" type="submit">Buscar</button>
        </form>
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
<h3 class="text-center">HISTORIAL ADMINISTRADORES</h3> 
<div class="mb-3"></div> <!--Salto de linea-->
            <!-- ALERTA -->
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> 

<div class="container">
  <div class="row">
    <div class="col-12">
    
    <!--Aqui va el modal de formulario-->

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Nuevo Registro
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="card-body">
            
            <!--Faltaba el method POST -->
            <form action="../Controlador/controlador_registrar_usuarios.php" method="POST" class="row g-3 needs-validation" id="myForm" novalidate>
            
            <div class="col-md-12">
              <h6></h6>

            <!-- ALERTA 
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> -->
      

              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="nombre" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name=ap id="ap" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="am" id="am" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo Electronico *</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #1E90FF;" name="email" id="email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña *</label>
              <input type="password" class="form-control" style="border: 2px solid #1E90FF;" name="pass" id="pass" aria-describedby="passwordHelp" required>
              <div class="invalid-feedback">
                Su contraseña debe de tener entre 8 y 16 caracteres, contener letras y numeros, y no debe contener espacios.
              </div>
              <br>
            </div>
            <div class="col-md-6">
            <select class="form-select" id="rol" name="rol" style="border: 2px solid #1E90FF;" required>
              <option selected value="" >Seleccione cual es su Rol *</option>
              <option value="1">Recepcion IT-Global</option>
              <option value="2">Recepcion UrSpace</option>
              <option value="3">Seguridad</option>
            </select>
             </div>
             <div class="col-md-6">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #1E90FF;" required>
              <option selected value="">Seleccione con la que mejor se identifique *</option>
              <option value="1">Nombre del mejor amigo</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #1E90FF;" id="respuesta" name="respuesta" required>
             </div>
            <div class="col-12">
              <input type="submit" value="Registrarse" class="btn btn-primary" name="Registrar"></button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
            </div>
            </form>
          </div>

      </div>

    </div>
  </div>
</div>


    </div>
  </div>
</div>
<div class="mb-4"></div> <!--Salto de linea-->
<div class="container">
  <div class="row">
    <div class="col">
    <div class="table-responsive my-custom-scrollbar">
  <table class="table table-bordered table-striped mb-0">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido Paterno</th>
        <th scope="col">Apellido Materno</th>
        <th scope="col">Correo Electronico</th>
        <th scope="col">Rol</th>
        <th scope="col">Estatus</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "select * from srcv_administradores");
            while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo$filas ["ID_ADMINISTRADOR"] ?></td>
            <td><?php echo$filas ["NOMBRE"] ?></td>
            <td><?php echo$filas ["APELLIDO_PATERNO"] ?></td>
            <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
            <td><?php echo $filas['CORREO_ELECTRONICO'] ?></td>
            <td><?php echo $filas['ROL'] ?></td>
            <td><?php echo $filas['ESTATUS'] ?></td>
            <td>
            <a href="#" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
            <a href="#"><i class="fa fa-trash-o" aria-hidden="true" onclick="eliminar()" ></i></a>
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

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>

  //Limpiar fromulario
  function limpiar() {
      var formulario = document.getElementById("myForm");
      // Resetear el formulario
      formulario.reset();
    }

    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

</script>
</body>
</html>