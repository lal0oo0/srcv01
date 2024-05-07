<?php
require_once '../Modelo/conexion2.php';
if (isset($_SESSION['recuperacion_exitosa']) && $_SESSION['recuperacion_exitosa']) {
    $mensaje_enviado = true;
} else {
    $mensaje_enviado = false;
}

// Verificar si hay un correo almacenado en la sesión
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo']; // Asignar el valor del correo almacenado en la sesión a la variable $correo
} else {
    $correo = ''; // Establecer un valor predeterminado si no hay un correo almacenado en la sesión
}

$correo = '';
$mensaje = '';
$correo_hidden = '';
$correo_encontrado = false;
$correo_mostrado = true;
$correo_validado = true;


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body{
    background-color: #007AB6 ;
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
    margin-bottom: 35px;
  }

  .btn-group{
    margin-bottom: 35px;
    background-attachment: fixed;
    background-color: red;
  }

  .was-validated .form-select:valid {
  background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px,url("data:image/vg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") no-repeat center right 1.75rem/1.125rem 1.125rem !important;
}

.was-validated .form-select:invalid {
  background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px,url("data:image/vg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") no-repeat center right 1.75rem/1.125rem 1.125rem !important;
}

#respues:valid {
  background-image: none;
}

#respues:invalid {
  background-image: none;
}

.border-0 {
    border: none;
}

/* Elimina el icono de confirmación de la contraseña */
#confirmPasswo:valid{
        background-image: none;
        /* Deja solo el borde */
        border: 2px solid #007AB6;
    }

/* Estilo para que el texto del checkbox se estire y no se divida en varias líneas */
.form-check-label {
            white-space: nowrap;
        }

.was-validated .form-check-label:valid {
    background-color: transparent;
    border-color: #000; /* Color del borde negro */
}

.was-validated .form-check-label:invalid {
    background-color: transparent;
    border-color: #000; /* Color del borde negro */
}

#flexCheckDefault + label.form-check-label {
    color: black; /* Cambia el color del texto del checkbox */
}

    </style>
</head>
<body>
<?php if ($mensaje_enviado): ?>
    <!-- Aquí puedes agregar cualquier código adicional que desees mostrar después de enviar el correo y actualizar la contraseña -->
<?php endif; ?>
    <div class="container text-center">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card-body">
                    <br>
                    <div class="col-12 user-img">
                        <img src="../imagenes/logocorporativo.png" alt="" class="logo">
                    </div>
                    <form action="../PHPMailer/controlador_pregunta_respuesta.php" method="POST" id="formulario3" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-12">
                    <input type="email" class="form-control"  id="correo" name="correo" aria-describedby="emailHelp" required disabled value="<?php echo htmlspecialchars($correo); ?>">
                            </div>
                        <div class="col-md-12">
                            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #007AB6;" required>
                                <option selected value="">Seleccione con la que mejor se identifique *</option>
                                <option value="1">Nombre del mejor amig@</option>
                                <option value="2">Nombre de la mascota</option>
                                <option value="3">Película Favorita</option>
                            </select>
                            <input type="text" class="form-control" style="border: 2px solid #007AB6;" id="respuesta" name="respuesta" required>
                        </div>
                        <!--div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input d-flex align-items-center" type="checkbox" value="" style="border: 2px solid #007AB6;" id="flexCheckDefault" onclick="redirigirInterfaz()">
                                <label class="form-check-label" for="flexCheckDefault" >
                                No te sabes tu pregunta y respuesta
                                </label>
                            </div>
                        </div>
                        <div class= "col-md-1"></div-->
                            <div class="col-md-6">
                                <label for="passwo1" class="form-label">Agregar nueva contraseña</label>
                                <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="passwo1" name="passwo1" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                                <div class="invalid-feedback">*Campo obligatorio</div>
                            </div>
                        <div class="col-md-6">
                            <label for="confirmPasswo" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="confirmPasswo" name="confirmPasswo" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                            <div class="invalid-feedback" id="passwordMismatch" style="color: red; display: none;">
                             Las contraseñas no coinciden.
                             </div>
                        </div>
                        <?php $correo_encontrado = true; ?>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="enviar" onclick="return validarCampos()" name="enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
        (() => {
            'use strict'

            // Recupera todos los formularios a los que queremos aplicar estilos de validación Bootstrap personalizados
            const forms = document.querySelectorAll('.needs-validation')

            // Bucle sobre ellos y evitar la presentación
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
    <script>
    // Función para alternar la visibilidad de la contraseña
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('passwo1'); // Campo de contraseña
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
        const confirmPasswordInput = document.getElementById('confirmPasswo'); // Campo de confirmación de contraseña
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
<script>
    // Script de validación de contraseñas
    document.getElementById('confirmPasswo').addEventListener('input', function() {
        var passwo1 = document.getElementById('passwo1').value;
        var confirmPasswo = this.value;
        var mensajeError = document.getElementById('passwordMismatch');

        if (passwo1 !== confirmPasswo) {
            mensajeError.style.display = 'block';
            this.classList.add('is-invalid');
        } else {
            mensajeError.style.display = 'none';
            this.classList.remove('is-invalid');
        }
    });
</script>
<script>
    // Script de validación de contraseñas
    document.getElementById('confirmPasswo').addEventListener('input', function() {
        var passwo1 = document.getElementById('passwo1').value;
        var confirmPasswo = this.value;
        var mensajeError = document.getElementById('passwordMismatch');
        var confirmPasswoInput = document.getElementById('confirmPasswo');

        if (passwo1 !== confirmPasswo) {
            mensajeError.style.display = 'block';
            confirmPasswoInput.classList.add('is-invalid');
            confirmPasswoInput.setCustomValidity('Las contraseñas no coinciden'); // Marcar como inválido
        } else {
            mensajeError.style.display = 'none';
            confirmPasswoInput.classList.remove('is-invalid');
            confirmPasswoInput.setCustomValidity(''); // Restablecer la validez
        }
    });
    // Función para mostrar SweetAlert y enviar formulario después de 5 segundos
    function mostrarSweetAlert() {
        swal({
            title: "Enviando correo y actualizando contraseña",
            text: "Espere unos momentos...",
            icon: "info",
            buttons: false, // No mostrar botones
            closeOnClickOutside: false, // No cerrar al hacer clic fuera del modal
            closeOnEsc: false // No cerrar al presionar la tecla Esc
        });

        setTimeout(function () {
            document.getElementById("formulario3").submit(); // Envía el formulario
        }, 5000);
    }
</script>
<script>
    function redirigirInterfaz() {
        // Aquí puedes especificar la URL de la interfaz a la que quieres redirigir
        window.location.href = '../Vista/vista_verificar_codigo.php';
    }
</script>
<script>
    document.getElementById("correo").disabled = true;
</script>
</body>
</html>