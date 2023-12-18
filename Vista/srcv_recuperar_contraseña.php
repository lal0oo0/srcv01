<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<style>

  body{
    background-image: url(https://www.3monlinestore-pro.jp/img/goods/L/CAL-JS-66102XL.jpg);
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
    min-height: 520px;
    width: 520px;
    border: 2px solid #ffffff;
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
      <img class="logo" url=() alt="">
      <div class="row justify-content-center">
        <div class="col-11">
          <div class="card-body">
          <form class="row g-3 needs-validation" novalidate>
            <h1>Escoja la cual le agrade</h1>
            <div class="col-sm-12">
              <label for="validationCustom01" class="form-label">Nombre del mejor amigo</label>
              <input type="text" class="form-control" id="validationCustom01" disable="" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom02" class="form-label">Pelicula Favorita</label>
              <input type="text" class="form-control" id="validationCustom02" required>
              <div class="invalid-feedback">
                Rellene este campo, por favor
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom03" class="form-label">Nombre de tu mascota</label>
              <input type="text" class="form-control" id="validationCustom03" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <br><br><br><br>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" href="#">Aceptar</button>
            </div>
          </form>
          </div>
        </div>
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
