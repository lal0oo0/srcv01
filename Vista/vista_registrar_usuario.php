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
    $categorias = mysqli_query ($conexion, "select * from srcv_administradores");
  ?>
<style>

  body{
    background-color: blue;
    background-size: cover;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    /*max width: 400px;*/
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
   /* border radius: 8px;*/
    position: relative;
    overflow: hidden;
    padding: 3.5rem;
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.7);
  }
  
  .logo{
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 2.5px solid #1E90FF;
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
            <img src="../imagenes/unnamed.jpg" alt="" class="logo">
            </div>
            
            <!--Faltaba el method POST -->
            <form action="../Controlador/controlador_registrar_usuarios.php" method="POST" class="row g-3 needs-validation" novalidate>
            
            <div class="col-md-12">
              <h6></h6>

            <!-- ALERTA -->
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> 
      

              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF" name="nombre" id="nombre" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name=ap id="ap" required>
              <div class="invalid-feedback">
                Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" name="am" id="am" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo Electronico</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #1E90FF;" name="email" id="email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Rellene este campo, por favor
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña</label>
              <input type="password" class="form-control" style="border: 2px solid #1E90FF;" name="pass" id="pass" aria-describedby="passwordHelp" required>
              <div class="invalid-feedback">
                Su contraseña debe de tener entre 8 y 16 caracteres, contener letras y numeros, y no debe contener espacios.
              </div>
              <br>
            </div>
            <div class="col-md-6">
            <select class="form-select" id="rol" name="rol" style="border: 2px solid #1E90FF;" required>
              <option selected value="" >Seleccione cual es su Rol </option>
              <option value="1">Recepcion IT-Global</option>
              <option value="2">Recepcion UrSpace</option>
              <option value="3">Seguridad</option>
            </select>
             </div>
             <div class="col-md-6">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #1E90FF;" required>
              <option selected value="">Seleccione con la que mejor se identifique </option>
              <option value="1">Nombre del mejor amigo</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #1E90FF;" id="respuesta" name="respuesta" required>
             </div>
            <div class="col-12">
              <input type="submit" value="Registrarse" class="btn btn-primary" name="Registrar"></button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!--ESTO SE TIENE QUE CAMBIAR A LOCAL -->
    <script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
  </body>
  
  
 <!--QUITAR LOS COMENTARIOS EN INGLÉS-->  
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
})()
  </script>
</html>
