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
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
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

  /* Elimina el icono de confirmación de la contraseña */
  #pass_confirmar:valid{
            background-image: none;
            /* Deja solo el borde */
            border: 2px solid #007AB6;
        }

        .input-group > .form-control {
    padding-right: 38px; /* Ajusta el padding derecho para dejar espacio para el icono de ojo */
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
              <input type="text" class="form-control" style="border: 2px solid #007AB6" name="nombre" id="valid01" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required>
              <div class="invalid-feedback" id="nombre"></div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name=ap id="valid02" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
              <div class="invalid-feedback" id="ap"></div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name="am" id="valid03" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
              <div class="invalid-feedback" id="am"></div>
            </div>
            <div class="col-md-12">
              <label for="email" class="form-label">Correo Electrónico *</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" style="border: 2px solid #007AB6;" name="email" id="email" aria-describedby="emailHelp" pattern="[a-zA-ZñÑ0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                <div class="invalid-feedback">
                  Campo obligatorio*
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña *</label>
              <div class="input-group has-validation">
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" name="pass" id="valid04" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
              <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="togglePassword">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </button>
              <div class="invalid-feedback " id="pass"></div>
              </div>
              <br>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Confirmar contraseña *</label>
              <div class="input-group has-validation">
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" name="pass_confirmar" id="pass_confirmar" required>
              <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="toggleConfirmPassword">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </button>
              <div class="invalid-feedback " id="confirmar"></div>
              </div>
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
            <input type="submit" value="Registrarse" class="btn btn-primary">
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

        if (passConfirmar === '') {
            var com = document.getElementById('confirmar');
            com.innerHTML = "*Campo obligatorio";
            document.getElementById('pass_confirmar').classList.add('is-invalid');
            valid = false;
        }

        var nombre = document.getElementById('valid01').value;
        var ap = document.getElementById('valid02').value;
        var am = document.getElementById('valid03').value;
        var pregunta = document.getElementById('pregunta').value;
        var respuesta = document.getElementById('respuesta').value;

        // Validación de que no se pueden agregar números en el nombre y apellidos
        if (/.*\d.*/.test(nombre)) { // Comprueba si hay algún número en el nombre
            document.getElementById('nombre').innerHTML = "*El nombre no puede contener números";
            document.getElementById('valid01').classList.add('is-invalid');
            valid = false;
        } else {
            document.getElementById('nombre').innerHTML = '';
            document.getElementById('valid01').classList.remove('is-invalid');
        }

        if (/.*\d.*/.test(ap)) { // Comprueba si hay algún número en el apellido paterno
            document.getElementById('ap').innerHTML = "*El apellido paterno no puede contener números";
            document.getElementById('valid02').classList.add('is-invalid');
            valid = false;
        } else {
            document.getElementById('ap').innerHTML = '';
            document.getElementById('valid02').classList.remove('is-invalid');
        }

        if (/.*\d.*/.test(am)) { // Comprueba si hay algún número en el apellido materno
            document.getElementById('am').innerHTML = "*El apellido materno no puede contener números";
            document.getElementById('valid03').classList.add('is-invalid');
            valid = false;
        } else {
            document.getElementById('am').innerHTML = '';
            document.getElementById('valid03').classList.remove('is-invalid');
        }

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

    // Evitar el envío del formulario si hay campos inválidos
    $(".formulario").submit(function(e) {
        var nombreValido = !document.getElementById('valid01').classList.contains('is-invalid');
        var apValido = !document.getElementById('valid02').classList.contains('is-invalid');
        var amValido = !document.getElementById('valid03').classList.contains('is-invalid');

        if (!nombreValido || !apValido || !amValido) {
            e.preventDefault(); // Evitar el envío del formulario
            swal('Error', 'Por favor, corrija los campos marcados como inválidos.', 'error');
        }
    });
});
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
