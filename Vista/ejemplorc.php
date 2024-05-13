<?php

session_start();

require_once '../Modelo/conexion2.php';
require_once '../PHPMailer/ejemplocontroladorrc.php';
if (isset($_SESSION['recuperacion_exitosa']) && $_SESSION['recuperacion_exitosa']) {
    $mensaje_enviado = true;
} else {
    $mensaje_enviado = false;
}

// Obtener el correo electrónico
$correo = ""; // Inicializa una variable para almacenar el correo electrónico
if (isset($_POST['correo'])) {
    $correo = htmlspecialchars($_POST['correo']);
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

#enviarCodigoCheckbox + label.form-check-label {
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
                            <div class="form-check">
                                <input class="form-check-input d-flex align-items-center" type="checkbox" value="" style="border: 2px solid #007AB6;" id="enviarCodigoCheckbox">
                                <label class="form-check-label" for="enviarCodigoCheckbox" style="font-size: 18px;">
                                No recuerdo mi pregunta y respuesta de seguridad.
                                </label>
                            </div>
                        </div>
                        <div class= "col-md-1"></div>
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
                        <?php endif; ?>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="enviar" onclick="return validarCampos()" name="enviar">Siguiente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Codigo verificacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="email" class="form-control" name="correo_modal" id="correo_modal" disabled value="<?php echo $correo; ?>">
      <label for="" class="form-label">Ingrese el codigo</label>
        <div class="input-group has-validation">
        <input type="codigo" style="border: 2px solid #007AB6;" class="form-control" name="codigo" id="codigo" placeholder="Ingrese su codigo que le mandamos en su correo" required maxlength="8">
        <div class="invalid-feedback">
        *Campo obligatorio
            </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="verificarCodigo()">Verificar</button>
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
    function validarCampos() {
        var formulario = document.getElementById("formulario3");

        // Verificar si el formulario es válido según las validaciones de Bootstrap
        if (!formulario.checkValidity()) {
            // Si el formulario no es válido, mostrar las validaciones de Bootstrap
            formulario.classList.add('was-validated');
            return false;
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
    }

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
    // Escuchar cambios en el checkbox
    $(document).ready(function() {
        $('#enviarCodigoCheckbox').change(function() {
            if ($(this).is(':checked')) {
                enviarCodigoVerificacion();
            }
        });
    });

    // Función para enviar el código de verificación por correo
    function enviarCodigoVerificacion() {
    // Verificar si el checkbox está marcado
    if ($('#enviarCodigoCheckbox').is(':checked')) {
        // Obtener el correo electrónico del campo
        var correo = $('#correo').val();

        // Validar que haya un correo electrónico
        if (correo.trim() === '') {
            alert('Por favor ingresa un correo electrónico válido.');
            return;
        }

        // Enviar solicitud AJAX para enviar el correo
        $.ajax({
            type: 'POST',
            url: '../PHPMailer/controlador_verificar_contrasena.php', // Ruta a tu controlador para enviar el correo
            data: { correo: correo },
            success: function(response) {
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }
        });
    }
}
</script>
<script>
// Función para abrir el modal cuando se seleccione el checkbox
function abrirModal() {
  $('#myModal').modal('show'); // Abre el modal utilizando jQuery
}

// Escuchar cambios en el checkbox
$(document).ready(function() {
    $('#enviarCodigoCheckbox').change(function() {
        if ($(this).is(':checked')) {
            abrirModal(); // Llama a la función para abrir el modal
        }
    });
});
</script>
<script>
    // Función para limpiar el modal después de ingresar el código correctamente
    function limpiarModal() {
        // Restablecer el valor del campo de código
        $('#codigo').val('');
        
        // Eliminar cualquier mensaje de error presente
        $('.modal-body .invalid-feedback').hide();
    }

    // Función para verificar el código de verificación
    function verificarCodigo() {
        // Obtener el código ingresado
        var codigo = $('#codigo').val();
        var correo_modal = $('#correo_modal').val();

        // Validar que se haya ingresado un código
        if (codigo.trim() === '') {
            alert('Por favor ingresa el código de verificación.');
            return;
        }

        // Enviar solicitud AJAX para verificar el código
        $.ajax({
            type: 'POST',
            url: '../PHPMailer/controlador_verificar_contrasena.php',
            data: { codigo: codigo, correo_modal: correo_modal },
            success: function(response) {
                // Procesar la respuesta del servidor
                if (response === 'correcto') {
                    swal('Código correcto. Puedes proceder con la recuperación de contraseña.');
                    $('#myModal').modal('hide');
                    window.location.href = '../Vista/ejemplorc.php';
                    limpiarModal(); // Limpia el modal
                } else {
                    swal("El código de verificación ingresado no es válido",{
                    icon: "error",
                    buttons: "Ok", 
                     });
                    limpiarModal(); // Limpia el modal
                }
            },
            error: function() {
                swal('Error en la solicitud AJAX.');
                limpiarModal(); // Limpia el modal
            }
        });
    }

    // Escuchar el evento cuando el modal se cierra
    $('#myModal').on('hidden.bs.modal', function () {
        limpiarModal(); // Limpia el modal
        // Habilitar la pregunta y la respuesta de seguridad
        $('#pregunta').prop('disabled', false);
        $('#respuesta').prop('disabled', false);
    });

    $(document).ready(function() {
        $('#enviarCodigoCheckbox').change(function() {
            if ($(this).is(':checked')) {
                // Si el checkbox está marcado, deshabilitar la pregunta y la respuesta
                $('#pregunta').prop('disabled', true);
                $('#respuesta').prop('disabled', true);
            } else {
                // Si el checkbox está desmarcado, habilitar la pregunta y la respuesta
                $('#pregunta').prop('disabled', false);
                $('#respuesta').prop('disabled', false);
            }
        });
    });
</script>
<script>
    // Función para desmarcar el checkbox cuando se cierra el modal
    $('#myModal').on('hidden.bs.modal', function () {
        $('#enviarCodigoCheckbox').prop('checked', false); // Desmarca el checkbox
    });
</script>
</body>
</html>
