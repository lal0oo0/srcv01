<?php
require_once '../Modelo/conexion2.php';
if (isset($_SESSION['recuperacion_exitosa']) && $_SESSION['recuperacion_exitosa']) {
    $mensaje_enviado = true;
} else {
    $mensaje_enviado = false;
}

$correo = '';
$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
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
                    <form action="../PHPMailer/controlador_verificar_contraseña.php" method="POST" id="formulario3" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <h3>Codigo de verificacion</h3>
                            <?php echo $mensaje; ?>
                            <div class="col-md-12">
                            <div class="input-group has-validation">
                            <input type="email" style="border: 2px solid #007AB6;" class="form-control <?php if ($correo_encontrado) echo 'border-0'; ?>" name="correo" id="correo" aria-describedby="emailHelp" required <?php if (!$correo_mostrado) echo 'disabled'; ?> value="<?php echo htmlspecialchars($correo); ?>">
                                </div>
                            </div>
                            <label for="validationexampleInputEmail1" class="form-label">Ingrese su codigo</label>
                            <div class="input-group has-validation">
                            <input type="codigo" style="border: 2px solid #007AB6;" class="form-control" name="codigo" id="codigo" placeholder="ingrese su codigo de verificacion" required maxlength="8">
                                <div class="invalid-feedback">
                                    *Campo obligatorio
                                </div>
                            </div>
                        </div>
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
                            <div class="col-12 d-flex justify-content-center">
                                <div style="display: flex; justify-content: space-between;">
                                <button class="btn btn-primary" type="button" id="enviar_codigo">Enviar Código de Verificación</button>
                            </div>
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
    // Función para validar campos y enviar formulario
    // Función para validar campos y enviar formulario
// Función para validar campos y enviar formulario
function validarCampos() {
        var formulario = document.getElementById("formulario3");
        var checkbox = document.getElementById("flexCheckDefault");
        var codigoRecuperacionInput = document.getElementById("codigo_recuperacion");

        // Verificar si el checkbox está seleccionado
        if (checkbox.checked) {
            // Si el checkbox está seleccionado, ocultar el campo de pregunta y respuesta
            document.getElementById("pregunta").setAttribute("disabled", "disabled");
            document.getElementById("respuesta").setAttribute("disabled", "disabled");
            // Mostrar el campo de código de recuperación
            document.getElementById("codigo_recuperacion_wrapper").style.display = "block";
        } else {
            // Si el checkbox no está seleccionado, mostrar el campo de pregunta y respuesta
            document.getElementById("pregunta").removeAttribute("disabled");
            document.getElementById("respuesta").removeAttribute("disabled");
            // Ocultar el campo de código de recuperación
            document.getElementById("codigo_recuperacion_wrapper").style.display = "none";
        }

        // Validar el formulario según las reglas actuales
        if (!formulario.checkValidity()) {
            // Si el formulario no es válido, mostrar las validaciones de Bootstrap
            formulario.classList.add('was-validated');
            return false;
        }

        // Si todo está bien, continuar con el envío del formulario
        return true;
    }

        var correo = document.getElementById("correo").value;
        var pregunta = document.getElementById("pregunta").value;
        var respuesta = document.getElementById("respuesta").value;
        var passwo1 = document.getElementById("passwo1").value;
        var confirmPasswo = document.getElementById("confirmPasswo").value;
        var mensajeError = document.getElementById('passwordMismatch');

        // Verificar si todos los campos requeridos están llenos
        if (correo.trim() === "" || pregunta.trim() === "" || respuesta.trim() === "" || passwo1.trim() === "" || confirmPasswo.trim() === "") {
            alert("Por favor, complete todos los campos.");
            return false;
        }

        // Verificar si las contraseñas coinciden
        if (passwo1 !== confirmPasswo) {
            mensajeError.style.display = 'block';
            document.getElementById('confirmPasswo').classList.add('is-invalid');
            return false;
        }

        // Si todo está bien, mostrar la SweetAlert y quitar las validaciones de Bootstrap
        mostrarSweetAlert();
        formulario.classList.remove('was-validated'); // Quitar las validaciones de Bootstrap
        return true;

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
    document.addEventListener("DOMContentLoaded", function() {
        var checkbox = document.getElementById("flexCheckDefault");
        var preguntaInput = document.getElementById("pregunta");
        var respuestaInput = document.getElementById("respuesta");
        var codigoRecuperacionInput = document.getElementById("codigo_recuperacion");
        var codigoRecuperacionWrapper = document.getElementById("codigo_recuperacion_wrapper");

        checkbox.addEventListener("change", function() {
            if (checkbox.checked) {
                // Si se selecciona la opción de no recordar, ocultar la pregunta y respuesta
                preguntaInput.style.display = "none";
                respuestaInput.style.display = "none";
                // Mostrar solo el campo para ingresar el código de recuperación
                codigoRecuperacionWrapper.style.display = "block";
            } else {
                // Si no se selecciona la opción de no recordar, mostrar la pregunta y respuesta
                preguntaInput.style.display = "block";
                respuestaInput.style.display = "block";
                // Ocultar campo para ingresar el código de recuperación
                codigoRecuperacionWrapper.style.display = "none";
            }
        });
    });
</script>
<script>
        // Función para deshabilitar la validación de los campos de contraseña cuando se seleccione el checkbox
        document.addEventListener("DOMContentLoaded", function() {
            var checkbox = document.getElementById("flexCheckDefault");
            var passwo1Input = document.getElementById("passwo1");
            var confirmPasswoInput = document.getElementById("confirmPasswo");

            checkbox.addEventListener("change", function() {
                if (checkbox.checked) {
                    // Si se selecciona la opción de no recordar, deshabilitar la validación de los campos de contraseña
                    passwo1Input.removeAttribute("required");
                    confirmPasswoInput.removeAttribute("required");
                    passwo1Input.classList.remove("is-invalid");
                    confirmPasswoInput.classList.remove("is-invalid");
                } else {
                    // Si no se selecciona la opción de no recordar, habilitar la validación de los campos de contraseña
                    passwo1Input.setAttribute("required", "");
                    confirmPasswoInput.setAttribute("required", "");
                }
            });
        });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var checkbox = document.getElementById("flexCheckDefault");
    var passwo1Input = document.getElementById("passwo1");
    var confirmPasswoInput = document.getElementById("confirmPasswo");

    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            // Deshabilitar campos de contraseña y confirmación
            passwo1Input.disabled = true;
            confirmPasswoInput.disabled = true;
        } else {
            // Habilitar campos de contraseña y confirmación
            passwo1Input.disabled = false;
            confirmPasswoInput.disabled = false;
        }
    });
});
</script>
<script>
        $(document).ready(function() {
            $('#enviar_codigo').click(function() {
                var correo = $('#correo').val();
                $.ajax({
                    url: '../PHPMailer/controlador_verificar_contraseña.php',
                    method: 'POST',
                    data: { correo: correo },
                    success: function(response) {
                        $('#mensaje').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>