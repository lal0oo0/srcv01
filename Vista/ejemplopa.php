<?php
//Codigo de conexion a la base de datos
require_once("../Modelo/conexion2.php");
/* Obtener la conexión a la base de datos */
$conexion = conect();


$sql = "SELECT COUNT(*) as total FROM srcv_administradores WHERE ROL = 'Administrador'";
$resultado = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultado);
$total = $row['total'];

if ($total > 0) {
  header('Location: ../Vista/vista_inicio_sesion.php');
  exit();
}
?>
<?php
  $mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
?>
<!DOCTYPE html>
<!-- Tiene que ser "ES" porque es español -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $sql = mysqli_query ($conexion, "select * from srcv_administradores");
  ?>
<style>
  body{
    background-color: #007AB6;
    background-size: cover;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    max width: 400px;
    font-size: 20px;
  }
  .submit{
    font-size: 20px;
    text-align: center;
  }
  .container{
    background: #FFFFFF;
    min-height: 20px;
    width: 820px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border radius: 8px;
    position: relative;
    overflow: hidden;
    padding: 3.5rem;
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.7);
  }
  
  .logo{
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 2.5px solid #007AB6;
    position: absolute;
    top: 100px;
    left: calc(50% - 50px);
    margin-top: -50px;
  }
  .box {
    width: 300px;
    transform: translate(10%, 0%);
  }
</style>
<body>
    <div class="container text-center">
    <br><br><br>
      <div class="row justify-content-center">
        <div class="col-11">
          <div class="card-body">
            <br>
            <div class="col-12 user-img">
            <img src="../imagenes/logocorporativo.png" alt="" class="logo">
            </div>
            
            
            <form action="../Controlador/controlador_registrar_usu.php" method="POST" class="formulario row g-3 needs-validation" novalidate>
            
            <div class="col-md-12">
              <h6></h6>
            <!-- ALERTA -->
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> 
              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6" name="nombre" id="valid01" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="nombre"></div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name=ap id="valid02" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="ap"></div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name="am" id="valid03" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="am"></div>
            </div>
            <div class="col-md-12">
              <label for="email" class="form-label">Correo Electrónico *</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #007AB6;" name="email" id="email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                  Campo obligatorio*
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña *</label>
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" name="pass" id="valid04" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
              <div class="invalid-feedback " id="pass"></div>
              <br>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Confirmar contraseña *</label>
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" name="pass_confirmar" id="pass_confirmar" required>
              <div class="invalid-feedback " id="confirmar"></div>
              <br>
            </div>
             <div class="col-md-12">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #007AB6;" required>
              <option selected value="">Seleccione una pregunta*</option>
              <option value="1">Nombre del mejor amig@</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #007AB6;" id="respuesta" name="respuesta" required>
             </div>
            <div class="col-12">
            <a href="vista_inicio_sesion.php"><input type="submit" value="Registrarse" class="btn btn-primary" name="Registrar"></a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://unpkg.com/@popperjs/core@2"></script><!--enlace para el tooltip-->
    <script src="https://unpkg.com/tippy.js@6"></script><!--enlace para agregar el tooltip-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--enlace para alertas de sweetalert-->
    <script src="../js/validator.js"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
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
  
 <!--QUITAR LOS COMENTARIOS EN INGLÉS-->  
 <script>
//bootstrap
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
})()
  </script>

<!--Alertas de sweetalert y para redirigir a el login
<script>
  // Espera a que el documento HTML esté completamente cargado antes de ejecutar el script
$(document).ready(function() {
    // Captura el evento de envío del formulario con la clase 'formulario'
    $(".formulario").submit(function(e) {
        // Previene el comportamiento predeterminado del formulario
        e.preventDefault();

        // Validaciones para el formulario

        var valid = true;

        document.getElementById('pass_confirmar').addEventListener('input', function() {
        var pass = document.getElementById('valid04').value;
        var passConfirmar = this.value;

        if (pass !== passConfirmar) {
                valid=false;
                var com = document.getElementById('confirmar');
                com.innerHTML = "*Las contraseñas no coinciden";
                this.setCustomValidity('Las contraseñas no coinciden');
                document.getElementById('pass_confirmar').classList.add('is-invalid');
                return;
            } else {
                this.setCustomValidity('');
                document.getElementById('pass_confirmar').classList.remove('is-invalid');
            }
        });

        var nombre = document.getElementById('valid01').value;
        var ap = document.getElementById('valid02').value;
        var am = document.getElementById('valid03').value;
        var pass = document.getElementById('valid04').value;
        var pregunta = document.getElementById('pregunta').value;
        var respuesta = document.getElementById('respuesta').value;
        //var confirmar = document.getElementById('pass_confirmar').value;
      
        if (nombre == '' || ap == '' || am == '' || pass == '' || pregunta == '' || respuesta == '' /*|| confirmar == ''*/) {
            valid = false;
            swal('Error', 'Todos los campos son obligatorios', 'error');
        }
        if (nombre.length < 3 || nombre.length > 30) {
            valid = false;
            var com = document.getElementById('nombre');
            com.innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('nombre').innerHTML = '';
        }
        if (ap.length < 3 || ap.length > 30) {
            valid = false;
            var com = document.getElementById('ap');
            com.innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('ap').innerHTML = '';
        }
        if (am.length < 3 || am.length > 30) {
            valid = false;
            var com = document.getElementById('am');
            com.innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('am').innerHTML = '';
        }
        if (pass.length < 8 || pass.length > 16) {
            valid = false;
            var com = document.getElementById('pass');
            com.innerHTML = "*Ingrese una contraseña válida";
        } else {
            document.getElementById('pass').innerHTML = '';
        }
        /*if (pass === '' || confirmar === '') {
        valid = false;
        swal('Error', 'Todos los campos de contraseña son obligatorios', 'error');
    } else if (pass !== confirmar) {
        valid = false;
        swal('Error', 'Las contraseñas no coinciden', 'error');
    }*/
        
        // Si alguna validación falla, no se envía el formulario
        if (!valid) {
            return;
        }
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
                        text: 'El administrador ya se encuentra registrado exitosamente!',
                        icon: 'success'
                    }).then(function() {
                        // Redirige a otra interfaz después de cerrar la alerta (opcional)
                        window.location.href = "../Vista/vista_inicio_sesion.php";
                    });
                } else {
                    // Muestra una alerta de error con SweetAlert
                    swal('Error', response.error, 'error');
                }
            }
        });
    });
});
</script>-->
<script>
$(document).ready(function() {
    $(".formulario").submit(function(e) {
        e.preventDefault();

        var valid = true;
//parte del codigo para confirmar la contraseña
        var pass = document.getElementById('valid04').value;
        var passConfirmar = document.getElementById('pass_confirmar').value;

        if (pass !== passConfirmar) {
            var com = document.getElementById('confirmar');
            com.innerHTML = "*Las contraseñas no coinciden";
            document.getElementById('pass_confirmar').classList.add('is-invalid');
            valid = false;
        } else {
            document.getElementById('confirmar').innerHTML = '';
            document.getElementById('pass_confirmar').classList.remove('is-invalid');
        }

        var nombre = document.getElementById('valid01').value;
        var ap = document.getElementById('valid02').value;
        var am = document.getElementById('valid03').value;
        var pregunta = document.getElementById('pregunta').value;
        var respuesta = document.getElementById('respuesta').value;

        if (nombre == '' || ap == '' || am == '' || pass == '' || pregunta == '' || respuesta == '' || passConfirmar == '') {
            valid = false;
            swal('Error', 'Todos los campos son obligatorios', 'error');
        }

        if (nombre.length < 3 || nombre.length > 30) {
            valid = false;
            document.getElementById('nombre').innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('nombre').innerHTML = '';
        }

        if (ap.length < 3 || ap.length > 30) {
            valid = false;
            document.getElementById('ap').innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('ap').innerHTML = '';
        }

        if (am.length < 3 || am.length > 30) {
            valid = false;
            document.getElementById('am').innerHTML = "*Campo obligatorio";
        } else {
            document.getElementById('am').innerHTML = '';
        }

        if (pass.length < 8 || pass.length > 16) {
            valid = false;
            document.getElementById('pass').innerHTML = "*Ingrese una contraseña válida";
        } else {
            document.getElementById('pass').innerHTML = '';
        }

        if (!valid) {
            return;
        }

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    swal({
                        title: 'Registro exitoso!',
                        text: 'El administrador ya se encuentra registrado exitosamente!',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = "../Vista/vista_inicio_sesion.php";
                    });
                } else {
                    swal('Error', response.error, 'error');
                }
            }
        });
    });
});
// Función para verificar la coincidencia de las contraseñas
function verificarContrasenas() {
            const pass = document.getElementById('valid04').value;
            const passConfirmar = document.getElementById('pass_confirmar').value;
            var confirmarMensaje = document.getElementById('confirmar');

            if (pass !== passConfirmar) {
                confirmarMensaje.innerHTML = "*Las contraseñas no coinciden";
                document.getElementById('pass_confirmar').classList.add('is-invalid');
                return false; // Las contraseñas no coinciden
            } else {
                confirmarMensaje.innerHTML = '';
                document.getElementById('pass_confirmar').classList.remove('is-invalid');
                return true; // Las contraseñas coinciden
            }
        }

        // Evento clic en el botón de enviar
        document.getElementById('enviar').addEventListener('click', function(event) {
            // Verificar las contraseñas
            if (!verificarContrasenas()) {
                event.preventDefault(); // Prevenir el envío del formulario si las contraseñas no coinciden
            }
        });
</script>
</body>
</html>
