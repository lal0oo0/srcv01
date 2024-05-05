<?php
require_once '../Modelo/conexion2.php';
require_once '../PHPMailer/ejemplocontroladorrc.php';
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
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="border: 2px solid #007AB6;">
                            <label class="form-check-label align-middle" for="flexCheckDefault" style="font-size: 17px">
                                No recuerdas tu pregunta de seguridad y respuesta
                            </label>
                            </div>
                            <div class="col-md-12" id="codigo_recuperacion_wrapper" style="display: none;">
                                <div class="input-group">
                                     <input type="text" class="form-control" style="border: 2px solid #007AB6;" id="codigo_recuperacion" name="codigo_recuperacion" placeholder="Ingrese el código de recuperación" maxlength="8" pattern="[A-Za-z0-9]{8}">
                                     <input type="hidden" name="action" value="enviar_codigo">
                                     <button class="btn btn-primary" type="submit" id="enviar_codigo" name="enviar_codigo" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Enviar código de verificación</button>
                                </div>
                            </div>
                            <div class="mb-1"></div>
                        <div class="col-md-6">
                             <label for="passwo1" class="form-label">Agregar nueva contraseña</label>
                             <div class="input-group has-validation">
                             <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="passwo1" name="passwo1" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                             <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="togglePassword">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                             <div class="invalid-feedback">*Campo obligatorio</div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPasswo" class="form-label">Confirmar contraseña</label>
                            <div class="input-group has-validation">
                            <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="confirmPasswo" name="confirmPasswo" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                            <button type="button" class="btn btn-outline-secondary" style="border: 2px solid #007AB6" id="toggleConfirmPassword">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                            <div class="invalid-feedback" id="passwordMismatch" style="color: red; display: none;">
                             Las contraseñas no coinciden.
                             </div>
                            </div>
                        </div>
                        <?php $correo_encontrado = true; ?>
                        <?php endif; ?>
                        <?php if ($mostrar_siguiente || $mostrar_enviar): ?>
                            <div class="col-12 d-flex justify-content-center">
                                <div style="display: flex; justify-content: space-between;">
                                    <?php if ($mostrar_siguiente): ?>
                                         <button class="btn btn-primary" type="submit" id="siguiente" onclick="verificarCorreo()" name="siguiente">Siguiente</button>
                        <?php endif; ?>
                    <?php if ($mostrar_enviar): ?>
                <button class="btn btn-primary" type="submit" id="enviar" onclick="enviarCorreo()" name="enviar">Enviar</button>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>