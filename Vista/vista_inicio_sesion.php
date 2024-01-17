<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iniciar sesion</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $categorias = mysqli_query ($conexion, "select * from srcv_administradores");
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
    <div class="container text-center">
    <br><br><br>
      <div class="row justify-content-center">
        <div class="col-9">
          <div class="card-body">
            <br>
            <div class="col-12 user-img">
            <img src="../imagenes/unnamed.jpg" alt="" class="logo">
            </div>
            <form action="../Controlador/controlador_inicio_sesion.php"  method="POST" class="row g-3 needs-validation" class="formulario" novalidate>
            <div class="col-12">
              <label for="validationexampleInputEmail1" class="form-label">Correo Electronico *</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #007AB6" name="correoelectronico" id="exampleInputEmail1" id="validationCustom04" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Campo obligatorio
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom03" class="form-label">Contraseña *</label>
              <input type="password" class="form-control" style="border: 2px solid #007AB6" name="contrasena" id="valid04" pattern="(?=^.{8,15}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" aria-describedby="passwordHelp" required>
              <div class="invalid-feedback" id="pass">
              Campo obligatorio
              </div>
            </div>
            <br><br><br>
            <div class="col-12">
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
          </form>
          </div>
          <br>
        </div>
        <div class="dropdown-divider"></div>
        <p class="fs-6"><a class="link-primary" class="text-decorative-none" href="vista_recuperar_contrasena.php">¿Haz olvidado tu contraseña?</a></p>
      </div>
    </div>
    <script src="../js/validator.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
  </body>
  <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
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
