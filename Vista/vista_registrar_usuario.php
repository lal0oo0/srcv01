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
    $sql = mysqli_query ($conexion, "select * from srcv_administradores");
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
            
            
            <form action="../Controlador/controlador_registrar_usu.php" method="POST" class="row g-3 needs-validation" novalidate>
            
            <div class="col-md-12">
              <h6></h6>

            <!-- ALERTA -->
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> 
      

              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6" name="nombre" id="valid01" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="nombre">
              Campo obligatorio
              </div>
            </div>
            <div class="col-md-6">
              <label for="ap" class="form-label">Apellido Paterno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name=ap id="valid02" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="ap">
                Campo obligatorio
              </div>
            </div>
            <div class="col-md-6">
              <label for="am" class="form-label">Apellido Materno *</label>
              <input type="text" class="form-control" style="border: 2px solid #007AB6;" name="am" id="valid03" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,30}" required>
              <div class="invalid-feedback" id="am">
              Campo obligatorio
              </div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo Electronico *</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #007AB6;" name="email" id="email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Campo obligatorio
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="pass" class="form-label">Contraseña *</label>
              <input type="password" class="form-control" style="border: 2px solid #007AB6;" name="pass" id="valid04" aria-describedby="passwordHelp" pattern="(?=^.{8,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" required>
              <div class="invalid-feedback " id="pass">
              Campo obligatorio
              </div>
              <br>
            </div>
             <div class="col-md-12">
            <select class="form-select" id="pregunta" name="pregunta" style="border: 2px solid #007AB6;" required>
              <option selected value="">Seleccione con la que mejor se identifique *</option>
              <option value="1">Nombre del mejor amig@</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #007AB6;" id="respuesta" name="respuesta" required>
             </div>
            <div class="col-12">
            <a href="vista_inicio_sesion.php"><input type="submit" value="Registrarse" class="btn btn-primary" name="Registrar"></a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="../js/validator.js"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
  
  
 <!--QUITAR LOS COMENTARIOS EN INGLÉS-->  
 <script>

(() => {
  'use strict'


  const forms = document.querySelectorAll('.needs-validation')


  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
  var valid=true;
  var nombre=document.getElementById('valid01').value;
  var ap=document.getElementById('valid02').value;
  var am=document.getElementById('valid03').value;
  var pass=document.getElementById('valid04').value;

  if (nombre=='') {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (nombre.length>3 || nombre.length<30) {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('nombre').innerHTML='';
  }

  if (ap=='') {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (ap.length>3 || ap.length<16) {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('ap').innerHTML='';
  }

  if (am=='') {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (am.length>3 || am.length<16) {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('am').innerHTML='';
  }


  if (pass=='') {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (pass.length>8 || pass.length<16) {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Debe de contener de 8-16 caracteres, por lo menos una mayuscula, un numero, sin espacios"
  }
  else{
    document.getElementById('pass').innerHTML='';
  }
  

  return valid;
})()
  </script>
</html>
