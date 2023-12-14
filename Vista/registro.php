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
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-size: 20px;
  }

  .submit{
    font-size: 20px;
  }

  

</style>
<body>
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-12">
          <form class="row g-3 needs-validation" novalidate>
            <div class="col-12">
              <label for="validationCustom01" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="validationCustom01" required>
              <div class="invalid-feedback">
                Te falto el nombre
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom02" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" id="validationCustom02" required>
              <div class="invalid-feedback">
                Te falto el Apellido Paterno
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom02" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" id="validationCustom02" required>
              <div class="invalid-feedback">
                Te falto el Apellido Materno
              </div>
            </div>
            <div class="col-12">
              <label for="validationexampleInputEmail1" class="form-label">Correo Electronico</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" id="exampleInputEmail1" id="validationCustom01" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                  Te falto el Correo Electronico
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom03" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="exampleInputPassword1" id="validationCustom02" required>
              <div class="invalid-feedback">
                Te falto la contraseña
              </div>
            </div>
            <br><br><br><br>
            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit" href="index.php">Registrarse</button>
            </div>
          </form>
        </div>
      </div>
    <script src="Validacion.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>