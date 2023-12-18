<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>inicio de usuario</title>

</head>
<style>

  body{
    background-image: url(https://thumbs.dreamstime.com/b/stream-binary-code-eps-vector-background-39246644.jpg);
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
    min-height: 420px;
    width: 520px;
    border: 0.5px solid #999;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    padding: 3.5rem;
  }

</style>
<body>
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-9">
        <form class="row g-3 needs-validation" novalidate>
          <div class="col-12">
            <label for="validationexampleInputEmail1" class="form-label">Correo Electronico</label>
            <div class="input-group has-validation">
              <input type="email" class="form-control" id="exampleInputEmail1" id="validationCustom01" aria-describedby="emailHelp" required>
              <div class="invalid-feedback">
                Requisito obligatorio
              </div>
            </div>
          </div>
          <div class="col-12">
            <label for="validationCustom03" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" id="validationCustom02" required>
            <div class="invalid-feedback">
              Requisito obligatorio
            </div>
          </div>
          <br><br><br><br>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Registrarse</button>
          </div>
          <br><br>
        </form>
        <div class="dropdown-divider"></div>
        <p class="fs-6"><a class="link-light" class="text-decorative-none" href="srcv_recuperar_contraseña.php">¿Haz olvidado tu contraseña?</a></p>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
