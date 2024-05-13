<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_administradores");
    
    session_start();
?>
<?php
$mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
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
  }

  .container{
    background: #FFFFFF;
    border:#000000;
    min-height: 320px;
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

</style>
<body>
    <div class="container text-center"><br>
    <div class="mb-5"></div><!--Salto de linea-->
      <div class="row justify-content-center">
        <div class="col-11">
          <div class="card-body"><br>
            <div class="col-12 user-img">
              <img src="../imagenes/logocorporativo.png" alt="" class="logo">
            </div>
            <div class="mb-2"></div><!--Salto de linea-->
            <h3 class="title">Recuperar Contraseña</h3>
            <div class="mb-4"></div><!--Salto de linea-->
            <!-- ALERTA -->
            <div class="mb-4"></div><!--Salto de linea-->
            <div id="mensaje">
              <?php echo $mensaje; ?>
            </div>
            <form action="../Controlador/controlador_ingresar_codigo.php"  method="POST" id="formulario3" class="row g-3 needs-validation formulario" novalidate>
              <div class="col-12">
                <input type="email" style="border: 2px solid #007AB6;" class="form-control" value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>" readonly>
              </div>
              <div class="col-md-12">
                <label for="" class="form-label">Ingrese el código enviado a su correo electrónico</label>
                <input type="text" class="form-control" style="border: 2px solid #007AB6;" id="codigo" name="codigo" required>
              </div>
              <div class="col-md-6">
                <label for="passwo1" class="form-label">Agregar nueva contraseña</label>
                <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="contrasena" name="contrasena" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                <div class="invalid-feedback">*Campo obligatorio</div>
              </div>
              <div class="col-md-6">
                <label for="confirmPasswo" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="confirmPasswo" name="confirmPasswo" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
                <div class="invalid-feedback" id="passwordMismatch" style="color: red; display: none;">
                  Las contraseñas no coinciden.
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit" id="enviar" onclick="return validarCampos()" name="enviar">GUARDAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
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

        var codigo = document.getElementById("codigo").value;
        var passwo1 = document.getElementById("contrasena").value;
        var confirmPasswo = document.getElementById("confirmPasswo").value;
        var mensajeError = document.getElementById('passwordMismatch');

        // Verificar si todos los campos requeridos están llenos
        if (codigo.trim() === "" || passwo1.trim() === "" || confirmPasswo.trim() === "") {
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
        var passwo1 = document.getElementById('contrasena').value;
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
</script>
<script>
 // Espera a que el documento HTML esté completamente cargado antes de ejecutar el script
$(document).ready(function() {
    // Captura el evento de envío del formulario con la clase 'formulario'
    $(".formulario").submit(function(e) {
        // Previene el comportamiento predeterminado del formulario
        e.preventDefault();
        
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
                        title: 'Éxito!',
                        text: 'La contraseña se ha actualizado correctamnete!',
                        icon: 'success'
                    }).then(function() {
                        // Redirige a la página de inicio de sesión después de cerrar la alerta
                        window.location.href = '../Vista/vista_inicio_sesion.php';
                    });
                } else {
                    // Muestra una alerta de error con SweetAlert
                    swal('Error', response.error, 'error');
                }
            }
        });
    });
});
</script>
<script>  
    //Script para mostrar alertas por determinado tiempo 
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el elemento de alerta
        var alerta = document.querySelector('.alert');

        // Verifica si se encontró el elemento de alerta
        if(alerta) {
            // Temporizador para eliminar la alerta después de 4 segundos (4000 milisegundos)
            setTimeout(function() {
                alerta.remove(); // Elimina la alerta del DOM
            }, 4000);
        }
    });
  //Fin del  scripyt
</script>
</body>
</html>