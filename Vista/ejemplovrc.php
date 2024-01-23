<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $categorias = mysqli_query ($conexion, "select * from srcv_administradores");
  ?>
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
            <form action="controlador_recuperar_contrasena.php" action="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-12">
              <h3>Recuperar contraseña</h3>
              <label for="validationexampleInputEmail1" class="form-label">Ingrese su correo electronico</label>
              <div class="input-group has-validation">
              <input type="email" class="form-control" style="border: 2px solid #007AB6;" name="email" id="email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Verifique si sus datos son correctos
                </div>
              </div>
            </div>
            <br>
            <div class="col-md-12">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #007AB6;" required>
              <option selected value="">Seleccione con la que mejor se identifique *</option>
              <option value="1">Nombre del mejor amig@</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #007AB6;" id="respuesta" name="respuesta" required>
             <div class="invalid-feedback " id="respuesta">
              Campo obligatorio
              </div>
             </div>
             <div class="col-md-12">
              <label for="pass" class="form-label">Confirmar nueva contraseña</label>
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" id="pass" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
              <div class="invalid-feedback " id="pass">
              Campo obligatorio
              </div>
              <br>
            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" value="enviar" name="enviar">Enviar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
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
  <script>
var input = document.getElementById('pass');

document.getElementById('email').addEventListener('click', function(e) {
  console.log('Vamos a habilitar el input text');
  input.disabled = false;
});

document.getElementById('pregunta').addEventListener('click', function(e) {
  console.log('Vamos a habilitar el input text');
  input.disabled = false;
});

document.getElementById('respuesta').addEventListener('click', function(e) {
  console.log('Vamos a habilitar el input text');
  input.disabled = false;
});

// evento para el input radio del "no"
document.getElementById('pass').addEventListener('click', function(e) {
  console.log('Vamos a deshabilitar el input text');
  input.disabled = true;
});
  </script>
</html>