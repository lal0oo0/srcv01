<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<style>

  body{
    background-image:url(https://th.bing.com/th/id/OIP.I7nhMVv7VInEc1BpBatiPQAAAA?rs=1&pid=ImgDetMain) ;
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
          <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-12">
              <h6></h6>
              <label for="validationCustom01" class="form-label">Nombre</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF" id="validationCustom01" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationCustom02" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" id="validationCustom02" required>
              <div class="invalid-feedback">
                Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationCustom03" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" style="border: 2px solid #1E90FF;" id="validationCustom03" required>
              <div class="invalid-feedback">
              Rellene este campo, por favor
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationexampleInputEmail1" class="form-label">Correo Electronico</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" style="border: 2px solid #1E90FF;" id="exampleInputEmail1" id="validationCustom04" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                Rellene este campo, por favor
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationCustom04" class="form-label">Contraseña</label>
              <input type="password" class="form-control" style="border: 2px solid #1E90FF;" id="exampleInputPassword1" id="validationCustom05" aria-describedby="passwordHelp" required>
              <div class="invalid-feedback">
                Su contraseña debe de tener entre 8 y 16 caracteres, contener letras y numeros, y no debe contener espacios.
              </div>
              <br>
            </div>
            <div class="col-md-6">
            <select class="form-select" style="border: 2px solid #000000;">
              <option selected disabled>Seleccione la cual se identifique </option>
              <option value="1">Nombre del mejor amigo</option>
              <option value="2">Nombre de la mascota</option>
              <option value="3">Pelicula Favorita</option>
              </select>
             <input type="text" class="form-control form-control-sm" style="border: 2px solid #1E90FF;" id="validationCustom07" required>
              <div class="invalid-feedback">
                </div>
             </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" href="inicio_sesion.php">Registrarse</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
