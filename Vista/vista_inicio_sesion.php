<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iniciar sesion</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<style>

  body{
    background-image:url(https://th.bing.com/th/id/OIP.I7nhMVv7VInEc1BpBatiPQAAAA?rs=1&pid=ImgDetMain);
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
    border: 2.5px solid #1E90FF;
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
          <form class="row g-3 needs-validation" novalidate>
            <div class="col-12">
              <label for="validationexampleInputEmail1" class="form-label">Correo Electronico</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #1E90FF" id="exampleInputEmail1" id="validationCustom04" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Rellene este campo, por favor
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom03" class="form-label">Contraseña</label>
              <input type="password" class="form-control" style="border: 2px solid #1E90FF" id="exampleInputPassword1" id="validationCustom05" aria-describedby="passwordHelp" required>
              <div class="invalid-feedback">
                Su contraseña debe de tener entre 8 y 16 caracteres, contener letras y numeros, y no debe contener espacios.
              </div>
            </div>
            <br><br><br>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" href="#">Registrarse</button>
            </div>
          </form>
          </div>
          <br>
        </div>
        <div class="dropdown-divider"></div>
        <p class="fs-6"><a class="link-primary" class="text-decorative-none" href="srcv_recuperar_contraseña.php">¿Haz olvidado tu contraseña?</a></p>
      </div>
    </div>
    <script src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
</html>