<?php
require_once '../Modelo/conexion2.php';
$conexion = conect();
$correo = '';
$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $correo = $_POST["email"];

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    } else {
        $sql = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Comprobar si se encontró el correo electrónico en la base de datos
        if ($result->num_rows > 0) {
            $correo_encontrado = true;
            $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">El correo electrónico está registrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $_SESSION['correo_encontrado'] = true;
            $correo_mostrado = false; // Deshabilitar el campo de entrada de correo electrónico
        } else {
            $mensaje = '<div class="alert alert-danger alert-dismissible fade show" role="alert">El correo electrónico no está registrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $_SESSION['correo_mostrado'] = true; // Mantener el campo de entrada de correo electrónico habilitado
        }
    }
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
    </style>
</head>
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
                    <form action="" method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <h3>Recuperar contraseña</h3>
                            <?php echo $mensaje; ?>
                            <label for="validationexampleInputEmail1" class="form-label">Ingrese su correo electrónico</label>
                            <div class="input-group has-validation">
                                <input type="email" class="form-control" style="border: 2px solid #007AB6;" name="email" id="email" aria-describedby="emailHelp" required <?php if (!$correo_mostrado) { echo 'disabled'; } ?> value="<?php echo ($correo_encontrado) ? htmlspecialchars($correo) : ''; ?>">
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
                            <input type="text" class="form-control" style="border: 2px solid #007AB6;" id="respues" name="respues" required>
                        </div>
                        <div class="col-md-12">
                            <label for="passwo" id="passwo" class="form-label">Agregar nueva contraseña</label>
                            <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="passwo1" name="passwo1" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                        </div>
                        <?php $correo_encontrado = true; ?>
                        <?php endif; ?>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="enviar" name="enviar" onclick="showHiddenInput()">Siguiente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
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
        })();
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var boton = document.getElementById("enviar");
        var emailInput = document.getElementById("email");
        <?php if ($correo_encontrado): ?>
            boton.textContent = "Enviar";
        <?php endif; ?>
        boton.addEventListener("click", function() {
            if (boton.textContent == "Siguiente" && emailInput.value !== "") {
                boton.textContent = "Enviar";
            } 
        });
    });
</script>
</body>
</html>