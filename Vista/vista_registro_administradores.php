<?php
session_start();
$ROL=$_SESSION['rol'];
$CORREO=$_SESSION['correo'];
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

  /* Elimina el icono de confirmación de la contraseña */
  #pass_confirmar:valid{
            background-image: none;
            /* Deja solo el borde */
            border: 2px solid #007AB6;
        }

        .input-group > .form-control {
    padding-right: 38px; /* Ajusta el padding derecho para dejar espacio para el icono de ojo */
}

#rol:valid{
            /* Deja solo el borde */
            border: 2px solid #007AB6;
        }

        #rol:invalid{
            /* Deja solo el borde */
            border: 2px solid #007AB6;
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
            <a class="nav-link active" href="vista_registro_administradores.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_registro_categorias.php">Categorías</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_visitas_administrador.php">Historial de Visitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_historial_reservaciones_admin.php">Historial reservaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vista_configuracion_correo.php">Configuracion de correo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar sesión</a>
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
<h3 class="text-center">USUARIOS</h3> 
<div class="mb-4"></div> <!--Salto de linea-->
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" id="mensaje">
    <?php echo $mensaje;?>
  </div>
  <div class="col md-1"></div>
</div>
<div class="mb-3"></div><!--Salto de linea-->

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
            
            <form action="../Controlador/controlador_registrar_usuarios.php" method="POST" class="row g-3 needs-validation" name="myForm" id="myForm" novalidate>
            
            <div class="col-md-12">
              <h6></h6>
      

              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="valid01" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name=ap id="valid02" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno *</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="am" id="valid03" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
              <div class="invalid-feedback">
              Ingrese informacion valida.
              </div>
            </div>
            <div class="col-md-12">
              <label for="email" class="form-label">Correo Electrónico *</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="email" id="email" aria-describedby="emailHelp" required autocomplete="username">
                <div class="invalid-feedback">
                Ingrese informacion valida.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña *</label>
              <div class="input-group has-validation">
              <input type="password" class="form-control" style="border: 2px solid #1E90FF;" name="pass" id="valid04" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required autocomplete="current-password">
              <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="togglePassword">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </button>
              <div class="invalid-feedback">
                Su contraseña debe de tener entre 8 y 16 caracteres, contener letras y numeros, y no debe contener espacios.
              </div>
              </div>
              </div>
              <div class="col-md-6">
              <label for="pass" class="form-label">Confirmar contraseña *</label>
              <div class="input-group has-validation">
              <input type="password" class="form-control" style="border: 2px solid #1E90FF;" name="pass_confirmar" id="pass_confirmar" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required autocomplete="current-password">
              <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="toggleConfirmPassword">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </button>
              <div class="invalid-feedback " id="confirmar"></div>
            </div>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-6">
                <select class="form-select" id="rol" name="rol" style="border: 2px solid #1E90FF;" required>
                <option selected value="">Seleccione cual es su Rol *</option>
                <option value="1">Recepcion IT-Global</option>
                <option value="2">Recepcion UrSpace</option>
                <option value="3">Seguridad</option>
            </select>
            <div class="invalid-feedback"></div>
            </div>
            <div class="col-md-6 text-md-end">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #1E90FF;" required>
                <option selected value="">Seleccione con la que mejor se identifique *</option>
                <option value="1">Nombre del mejor amigo</option>
                <option value="2">Nombre de la mascota</option>
                <option value="3">Película Favorita</option>
            </select>
                <input type="text" class="form-control form-control-sm" style="border: 2px solid #1E90FF;" id="respuesta" name="respuesta" required>
            </div>
            <div class="invalid-feedback"></div>
            </div>
            <br>
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
        <th scope="col">Nombre</th>
        <th scope="col">Apellido Paterno</th>
        <th scope="col">Apellido Materno</th>
        <th scope="col">Correo Electrónico</th>
        <th scope="col">Rol</th>
        <th scope="col">Estatus</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <?php
            require_once("../Modelo/conexion2.php");
            $conexion = conect();
            $query = mysqli_query ($conexion, "SELECT * FROM srcv_administradores");
            while($filas  = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo$filas ["NOMBRE"] ?></td>
            <td><?php echo$filas ["APELLIDO_PATERNO"] ?></td>
            <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
            <td><?php echo $filas['CORREO_ELECTRONICO'] ?></td>
            <td><?php echo $filas['ROL'] ?></td>
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
            if($filas["ESTATUS"]=='Activo'){
            ?>
            <a class="btn btn-danger btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;"
            href="../Controlador/controlador_eliminar_administrador.php?id=<?=$filas['ID_ADMINISTRADOR']?>" 
            id="botonDesactivar">
            Desactivar
            <i class="fa fa-times ms-1" aria-hidden="true" onclick="eliminar()" style="font-size: 12px;"></i>
            </a><div class="mb-1"></div>
            <?php
            }elseif($filas["ESTATUS"]=='Inactivo'){
            ?>
            <a href="../Controlador/controlador_activar_administrador.php?id=<?=$filas['ID_ADMINISTRADOR']?>" id="botonActivar" 
            class="btn btn-success btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;">
            Activar
            <i class="fa fa-check" aria-hidden="true" style="font-size: 12px;"></i>
            </a><div class="mb-1"></div>
            <?php
            }
            ?>
            
                  <!-- Modificar usuario -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_ADMINISTRADOR'] ?>" 
                    onclick="VISITA('<?php $filas['ID_ADMINISTRADOR'] ?>')" id="botonAdmin" 
                    class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 5 px; height: 20px; line-height: 1; color: black;">
                    Modificar
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 12px;"></i>
                    </a>

                  <!-- Modal para modificar usuarios-->
                  <div class="modal fade" id="exampleModal_<?php echo $filas['ID_ADMINISTRADOR'] ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar informacion de <?= $filas['NOMBRE'] ?></h1>
                          <input id="Administrador_<?php echo $filas['ID_ADMINISTRADOR'] ?>" name="idadmin" value="" hidden>
                            <input type="hidden" name="idadmin" id="idadmin" value="<?php echo $filas['ID_ADMINISTRADOR'] ?>">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3"></div> <!--Salto de linea-->
                        <!--agregar motivo de visita-->
                        <div class="modal-body">
                          <form action="../Controlador/controlador_editar_admin.php" class="formulario row g-3 needs-validation" id="<?php echo $idForm ;?>" name="<?php echo $idForm ;?>" method="post" novalidate>
                            <div class="mb-3"></div> <!-- Salto de línea -->
                              <input type="hidden" name="idadmin" id="idadmin" value="<?= $filas['ID_ADMINISTRADOR'] ?>">

                            <div class="col-md-12">
                              <label for="nombre" class="form-label">Nombre</label>
                              <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="valid01" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" value="<?php echo $filas['NOMBRE'] ?>" required>
                              <div class="invalid-feedback">
                              Ingrese informacion valida.
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="ap" class="form-label">Apellido Paterno</label>
                              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name=ap id="valid02" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" value="<?php echo $filas['APELLIDO_PATERNO']?>" required>
                              <div class="invalid-feedback">
                              Ingrese informacion valida.
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="am" class="form-label">Apellido Materno</label>
                              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="am" id="valid03" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" value="<?php echo $filas['APELLIDO_MATERNO']?>" required>
                              <div class="invalid-feedback">
                              Ingrese informacion valida.
                              </div>
                            </div>

                            <div class="col-md-12">
                              <label for="nombre" class="form-label">Correo electrónico</label>
                              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="correo" id="correo" aria-describedby="emailHelp" value="<?php echo $filas['CORREO_ELECTRONICO']?>" required>
                              <div class="invalid-feedback">
                              Ingrese informacion valida.
                              </div>
                            </div>

                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <label for="am" class="form-label">Rol</label>
                              <select class="form-select" id="rol" name="rol" style="border: 2px solid #1E90FF;" required>
                                <option selected value="<?php echo $filas['ROL']?>"><?php echo $filas['ROL']?></option>
                                <option value="1">Recepcion IT-Global</option>
                                <option value="2">Recepcion UrSpace</option>
                                <option value="3">Seguridad</option>
                              </select>
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="mb-3"></div> <!--Salto de linea-->
                            <div class="col-12">
                              <input type="submit" value="Confirmar" class="btn btn-primary" name="Registrar"></button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
                            </div>

                            <div class="mb-5"></div> <!--Salto de linea-->
                          </form>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="..js/validator.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
  <script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->


<script>
  // Crear tooltip para el botón 1
tippy('#botonActivar', {
        content: 'Activar usuario',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonDesactivar', {
        content: 'Desactivar usuario',
        placement: 'bottom',
      });

  //Script para agregar tooltip a la contraseña
  tippy('#valid04', {
        content: `
        <ul>
            <li>La contraseña debe contener de 8 a 16 caracteres</li>
            <li>Debe incluir al menos una mayúscula</li>
            <li>Debe incluir al menos una minúscula</li>
            <li>Debe incluir al menos un número</li>
            <li>Debe incluir al menos un caracter especial</li>
        </ul>
        `,
        allowHTML: true // Esto permite que el contenido del tooltip se interprete como HTML
    });
</script>

<script>
  //Limpiar fromulario
  function limpiar() {
      var formulario = document.getElementById("myForm");
      // Resetear el formulario
      formulario.reset();
    }

    (() => {
  'use strict'


  const forms = document.querySelectorAll('.needs-validation')


  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
  document.getElementById('myForm').addEventListener('submit', function(event) {
        var passConfirmar = document.getElementById('pass_confirmar').value;
        if (passConfirmar === '') {
            document.getElementById('confirmar').innerHTML = "Ingrese informacion valida.";
            document.getElementById('pass_confirmar').classList.add('is-invalid');
            event.preventDefault(); // Evita que se envíe el formulario
        }
    });
  var valid=true;
  var nombre=document.getElementById('valid01').value;
  var ap=document.getElementById('valid02').value;
  var am=document.getElementById('valid03').value;
  var pregunta = document.getElementById('pregunta').value;
  var respuesta = document.getElementById('respuesta').value;
  var pass=document.getElementById('valid04').value;

  if (nombre=='') {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (nombre.length>3 || nombre.length<30) {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('nombre').innerHTML='';
  }

  if (ap=='') {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (ap.length>3 || ap.length<16) {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('ap').innerHTML='';
  }

  if (am=='') {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (am.length>3 || am.length<16) {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('am').innerHTML='';
  }


  if (pass=='') {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (pass.length>8 || pass.length<16) {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Debe de contener de 8-16 caracteres, por lo menos una mayuscula, un numero, sin espacios"
  }
  else{
    document.getElementById('pass').innerHTML='';
  }
  

  return valid;
})()
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
<script>
     // Validación de contraseñas coincidentes
    document.getElementById('pass_confirmar').addEventListener('input', function() {
        var pass = document.getElementById('valid04').value;
        var passConfirmar = this.value;

        if (pass !== passConfirmar) {
            document.getElementById('confirmar').innerHTML = "*Las contraseñas no coinciden";
            this.classList.add('is-invalid');
            this.setCustomValidity('Las contraseñas no coinciden'); // Marcar como inválido
        } else {
            document.getElementById('confirmar').innerHTML = "";
            this.classList.remove('is-invalid');
            this.setCustomValidity(''); // Restablecer la validez
        }
    });
</script>
<script>
    document.getElementById('email').addEventListener('input', function() {
        var email = this.value.trim();
        var isValid = /^[a-zA-ZñÑ0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
        if (!isValid) {
            this.setCustomValidity('Por favor, ingrese un correo electrónico válido.');
            this.classList.add('is-invalid');
        } else {
            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        }
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    function capitalizeFirstLetter(input) {
        return input.replace(/(^|\s)\S/g, function(txt) {
            return txt.toUpperCase();
        });
    }

    document.getElementById('valid01').addEventListener('input', function() {
        var nombre = this.value.toLowerCase();
        nombre = capitalizeFirstLetter(nombre);
        this.value = nombre;
    });

    document.getElementById('valid02').addEventListener('input', function() {
        var ap = this.value.toLowerCase();
        ap = capitalizeFirstLetter(ap);
        this.value = ap;
    });

    document.getElementById('valid03').addEventListener('input', function() {
        var am = this.value.toLowerCase();
        am = capitalizeFirstLetter(am);
        this.value = am;
    });

    document.getElementById('respuesta').addEventListener('input', function() {
        var respuesta = this.value.toLowerCase();
        respuesta = capitalizeFirstLetter(respuesta);
        this.value = respuesta;
    });
});
</script>
<script>
    document.getElementById('email').addEventListener('input', function() {
        var email = this.value.trim();
        var isValid = /^[a-zA-ZñÑ0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
        if (!isValid) {
            this.setCustomValidity('Por favor, ingrese un correo electrónico válido.');
            this.classList.add('is-invalid');
        } else {
            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        }
    });
</script>
<script>
    // Función para alternar la visibilidad de la contraseña
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('valid04'); // Campo de contraseña
        const icon = document.querySelector('#togglePassword i');

        // Alterna entre tipo de entrada 'password' y 'text'
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    // Función para alternar la visibilidad de la confirmación de contraseña
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmPasswordInput = document.getElementById('pass_confirmar'); // Campo de confirmación de contraseña
        const icon = document.querySelector('#toggleConfirmPassword i');

        // Alterna entre tipo de entrada 'password' y 'text'
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            confirmPasswordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });
</script>
</body>
</html>