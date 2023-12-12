<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Primera interfaz</title>
</head>
<style>
   /*.navbar-with-bg {
      background-image: url('../imagenes/navbar.jpg');
      background-size: cover; 
      background-position: center; 
   }*/

   .navbar-custom {
    background-color: #1947AF; /* Puedes ajustar el código de color según tu preferencia */
    color: #FFFFFF;
  }
</style>

<body>
 
  <header>
  <nav class="navbar navbar-expand-lg  navbar-dark navbar-custom">
  <!--<nav  class="navbar navbar-expand-lg navbar-light bg-light navbar-with-bg">--> <!-- IMAGEN DE FONDO -->
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Nombre del sistema</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>



 <!--<script src="../js/bootstrap.min.js"></script> Sólo se inclye bundle o este -->
 <script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>