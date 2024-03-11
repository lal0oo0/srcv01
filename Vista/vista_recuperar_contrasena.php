<?php
require_once '../Modelo/conexion2.php';
require_once '../PHPMailer/controlador_recuperar_contrasena.php';
if (isset($_SESSION['recuperacion_exitosa']) && $_SESSION['recuperacion_exitosa']) {
    $mensaje_enviado = true;
} else {
    $mensaje_enviado = false;
}
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
                    <form action="" method="POST" id="formulario3" class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <h3>Recuperar contraseña</h3>
                            <?php echo $mensaje; ?>
                            <label for="validationexampleInputEmail1" class="form-label <?php if ($correo_encontrado) echo 'd-none'; ?>">Ingrese su correo electrónico</label>
                            <div class="input-group has-validation">
                            <input type="email" style="border: 2px solid #007AB6;" class="form-control <?php if ($correo_encontrado) echo 'border-0'; ?>" name="correo" id="correo" aria-describedby="emailHelp" required <?php if (!$correo_mostrado) echo 'disabled'; ?> value="<?php echo htmlspecialchars($correo); ?>">
                                <div class="invalid-feedback">
                                    *Campo obligatorio
                                </div>
                            </div>
                        </div>
                        <?php if ($correo_encontrado): ?>
                        <div class="col-md-12">
                            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #007AB6;" required>
                                <option selected value="">Seleccione con la que mejor se identifique *</option>
                                <option value="1">Nombre del mejor amig@</option>
                                <option value="2">Nombre de la mascota</option>
                                <option value="3">Película Favorita</option>
                            </select>
                            <input type="text" class="form-control" style="border: 2px solid #007AB6;" id="respuesta" name="respuesta" required>
                        </div>
                        <div class="col-md-6">
                             <label for="passwo1" class="form-label">Agregar nueva contraseña</label>
                             <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="passwo1" name="passwo1" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPasswo" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="confirmPasswo" name="confirmPasswo" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                            <div class="invalid-feedback" id="passwordMismatch" style="color: red; display: none;">
                             Las contraseñas no coinciden.
                             </div>
                        </div>
                        <?php $correo_encontrado = true; ?>
                        <?php endif; ?>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="enviar" onclick="mostrarSweetAlert()" name="enviar">Siguiente</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        var boton = document.getElementById("enviar");
        var emailInput = document.getElementById("correo");
        <?php if ($correo_encontrado): ?>
            boton.textContent = "Enviar";
        <?php endif; ?>
        boton.addEventListener("click", function() {
            if (boton.textContent == "Siguiente" && emailInput.value !== "") {
                boton.textContent = "Enviar";
            } 
        });
        setTimeout(function() {
            var alertas = document.querySelectorAll('.alert');
            alertas.forEach(function(alerta) {
                alerta.style.display = 'none';
            });
        }, 5000);
    });
    function verificarContrasenas() {
            const passwo1 = document.getElementById('passwo1').value;
            const confirmPasswo = document.getElementById('confirmPasswo').value;
            var mensajeError = document.getElementById('passwordMismatch');

            if (passwo1 !== confirmPasswo) {
                mensajeError.style.display = 'block';
                event.preventDefault(); // Detener el envío del formulario
                return false; // Las contraseñas no coinciden
            } else {
                mensajeError.style.display = 'none';
                return true; // Las contraseñas coinciden
            }
        }
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
            window.location.href = "../Vista/vista_inicio_sesion.php";
        }, 5000);
    }
</script>
</body>
</html>