<?php
  $mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Registar</title>
</head>
<style>

   .navbar  {
    background-color: #8E4566; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
    background-color: #F32B2B;
  }

  .my-custom-scrollbar {
  position: relative;
  height: 500px;
  overflow: auto;
  }

  .table-wrapper-scroll-y {
  display: block;
  }

  .navbar-custom {
    background-color: #64BAFF; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  .Titulo{
    color: white;
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $queryVisitas = mysqli_query ($conexion, "select * from srcv_visitas");
    $queryempresa = mysqli_query ($conexion, "select * from srcv_listas WHERE CATEGORIA='empresa'");
    $queryasunto = mysqli_query ($conexion, "select * from srcv_listas WHERE CATEGORIA='asunto'");
  ?>
 <!--aqui va la navbar-->
  <header> 
   <nav class="navbar navbar-dark  fixed-top navbar-custom" >
    <div class="container-fluid">
         <a class="navbar-brand" href="#"><img src="../imagenes/logo_it.png" width="60px"> SRCV Registro de Visitas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
           <div class="offcanvas-header">
            <h5 class="offcanvas-title Titulo" id="offcanvasDarkNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
         <div class="offcanvas-body">
         <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
           <li class="nav-item">
            <a class="nav-link active" href="http://localhost/srcv01/Vista/vista_historial_visitas.php">Historial de Visitas</a>
           </li>
           <li class="nav-item">
            <a class="nav-link active" href="#">Cerrar Sesion</a>
           </li>
           <li class="nav-item">
            <a class="nav-link active" href="#">Cerrar Aplicacion</a>
           </li>
         </ul>
           <form class="d-flex mt-3" role="search">
           <input class="form-control me-2" type="Buscar" placeholder="Buscar" aria-label="Buscar">
           <button class="btn btn-success" type="submit">Buscar</button>
           </form>
         </div>
       </div>
    </div>
   </nav>
  </header>
<br>
<br>
<br>
<br>

<div class="container">
    <div class="row-md-8">
      <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="background-color: #008B8B" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Nuevo Registro
        </button>
      
      <!-- ALERTA -->
            <div id="mensaje">
             <?php echo $mensaje; ?>
            </div>
            <div class="mb-3"></div> 
      
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">
                Nuevo Registro
              </h1>
       
               <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

             <!--aqui va el formulario-->

             <form id="myForm" action="../Controlador/controlador_registro_visitas.php" method="post" class="row g-3 needs-validation" novalidate>
             <h5>Rellene los campos</h5>

             <div class="mb-3"></div> <!-- Salto de línea -->

            <div class="row">
              <div class="col">
               <label for="he" class="form-label">Hora de entrada</label>
               <input type="time" class="form-control" id="he" name="he" required>
               <div class="invalid-feedback">
                 Verifique los datos
                </div>
              </div>

              <div class="col">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" disable="" required>
                <div class="invalid-feedback">
                 Verifique los datos
                </div>
              </div>
            </div>

              <br>
              <div class="col">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">
                 Verifique los datos
                </div>
              </div>
              
            <div class="row">
              <div class="col">
              <div class="mb-3"></div> <!-- Salto de línea -->
                <label for="ap" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="ap" name="ap" required>
                <div class="invalid-feedback">
                 Verifique los datos
                </div>
              </div>

              <div class="col">
              <div class="mb-3"></div> <!-- Salto de línea -->
                <label for="am" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="am" name="am" required>
                <div class="invalid-feedback">
                 Verifique los datos
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
              <div class="mb-3"></div> <!-- Salto de línea -->
               <label class="form-label" for="empresa">Empresa</label><br>
               <select class="form-select mr-sm-2" id="empresa" name="empresa" required>
               <div class="invalid-feedback">
                Verifique los datos
               </div>
               <option selected value="">Elige</option>
               <!--Se muestran las opciones de EMPRESA 
               previamente registradas en la tabla listas-->
                <?php
                while ($filas = mysqli_fetch_assoc($queryempresa)) 
                {
                ?>
               <option value="<?php echo $filas['NOMBRE']; ?>">
               <?php echo $filas['NOMBRE']; ?>
               </option>
               <?php
                }
               ?>
               </select>
              </div>

             <div class="col">
             <div class="mb-3"></div> <!-- Salto de línea -->
               <label class="form-label" for="asunto">Asunto</label><br>
               <select class="form-select mr-sm-2" id="asunto" name="asunto" required>
               <div class="invalid-feedback">
                Verifique los datos
               </div>
               <option selected value="" >Elige</option>
               <!--Se muestran las opciones de ASUNTO
               previamente registradas en la tabla listas-->
               <?php
               while ($filas = mysqli_fetch_assoc($queryasunto)) 
               {
               ?>
               <option value="<?php echo $filas['NOMBRE']; ?>">
               <?php echo $filas['NOMBRE']; ?>
               </option>
               <?php
               }
               ?>
               </select>
             </div>

                <div class="col">
                <div class="mb-3"></div> <!-- Salto de línea -->
                 <label for="hs" class="form-label">Hora de salida</label>
                 <input type="time" class="form-control" id="hs" name="hs">
                 <div class="invalid-feedback">
                 Verifique los datos
                 </div>
                </div>
            </div>
               <!--Botones para cancelar o enviar fromulario del modal-->
               <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
               </div>
               <br><br><br><br>
             </form>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!--Aqui comienza la tabla que muestra los registros de visitas-->
<div class="container">
  <div class="row">
    <div class="col-*-*">
    <div class="table-responsive my-custom-scrollbar">
     <table class="table table-bordered table-striped mb-0">
        <thead>
           <tr>
             <th scope="col">Hora de entrada</th>
             <th scope="col">Fecha</th>
             <th scope="col">Nombre</th>
             <th scope="col">Apellido Paterno</th>
             <th scope="col">Apellido Materno</th>
             <th scope="col">Empresa</th>
             <th scope="col">Asunto</th>
             <th scope="col">Hora de salida</th>
             <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
               <!--Se imprimen todos los resultados registrados previamente-->
               <?php
               while ($filas = mysqli_fetch_assoc($queryVisitas)) {
               ?>
                <tr>
                    <td><?php echo $filas['HORA_ENTRADA'] ?></td>
                    <td><?php echo $filas['FECHA'] ?></td>
                    <td><?php echo $filas['NOMBRE'] ?></td>
                    <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                    <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                    <td><?php echo $filas['EMPRESA'] ?></td>
                    <td><?php echo $filas['ASUNTO'] ?></td>
                    <td><?php echo $filas['HORA_SALIDA'] ?></td>
                    <td>
                        <a href="#"><button type="button" class="btn btn-secondary btn-sm" style="background-color:	#8AB7B0;"><img src="../imagenes/actualizar.png" width="20px"></button></a>
                        <a href="#"><button type="button" class="btn btn-secondary btn-sm" style="background-color:	#8AB7B0;"><img src="../imagenes/borra.png" width="20px"></button></a>
                    </td>
                </tr>
               <?php
               }
               ?>
        </tbody>
     </table>
    </div>
    </div>
  </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>

<script>
//VALIDACIONES
//Validacion de fecha
document.getElementById('myForm').addEventListener('submit', function(event) {
      var selectedDateValue = document.getElementById('fecha').value;

      // Verificar si el campo está vacío
      if (!selectedDateValue) {
        document.getElementById('fecha').classList.add('is-invalid');
        event.preventDefault(); // Evitar que el formulario se envíe
        return;
      }

      // Obtener la fecha actual en formato ISO sin la zona horaria
      var currentDate = new Date().toISOString().split('T')[0];

      // Verificar si la fecha seleccionada es anterior o igual a la fecha actual
      if (selectedDateValue < currentDate) {
        document.getElementById('fecha').classList.add('is-invalid');
        event.preventDefault(); // Evitar que el formulario se envíe
      } else {
        // Si la fecha es válida, eliminar la marca de inválido
        document.getElementById('fecha').classList.remove('is-invalid');
      }

      //VALIDAR HORA DE SALIDA
      var selectedTimeValue = document.getElementById('hs').value;
      var selectedTimeValue2 = document.getElementById('he').value;



// Verificar si la hora de salida es congruente 
if (selectedTimeValue < selectedTimeValue2) {
  document.getElementById('hs').classList.add('is-invalid');
  event.preventDefault(); // Evitar que el formulario se envíe
} else {
  // Si la hora es válida, eliminar la marca de inválido
  document.getElementById('hs').classList.remove('is-invalid');
}
    });

</script>

</body>
</html>