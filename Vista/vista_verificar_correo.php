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
            <form action="../Controlador/controlador_verificar_correo.php"  method="post" class="row g-3 needs-validation" class="formulario" novalidate>
              <div class="col-12">
                <label for="" class="form-label">Ingrese su correo electronico</label>
                <div class="input-group has-validation">
                  <input type="email" class="form-control" style="border: 2px solid #007AB6" name="correo" id="correo" aria-describedby="emailHelp" required>
                  <div class="invalid-feedback">
                  Campo obligatorio
                  </div>
                </div>
              </div>
              <div class="mb-2"></div><!--Salto de linea-->
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Siguiente</button>
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
<script>
// Script para validaciones
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
</body>
</html>