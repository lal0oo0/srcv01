<?php
session_start();
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}
?>

<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();
$correo = $_SESSION["correo"];
$sql  = "SELECT CORREO_ELECTRONICO, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo' ";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>

<?php
$mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">

  <title>Registar</title>
</head>
<style>
  .navbar {
    background-color: #8E4566;
    /* Darle color al NAV, del color que se necesite */
    font-size: 18px;
    /* Hacer las letras más grandes */
  }

  table.table th,
  table.table td {
    text-align: center;
  }

  thead {
    /*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top: 0;
    background-color: #F32B2B;
  }

  .my-custom-scrollbar {
    position: relative;
    height: 400px;
    overflow: auto;
  }

  .table-wrapper-scroll-y {
    display: block;
  }

  .navbar-custom {
    background-color: #64BAFF;
    /* Darle color al NAV, del color que se necesite */
    font-size: 18px;
    /* Hacer las letras más grandes */
  }

  .tit-color {
    color: white;
  }
  #botones{
    display: none;
  }

  .filtro{
    display: none;
  }
  
</style>

<body>
<?php
  date_default_timezone_set('America/Mexico_City');
  $hoy=date("Y-m-d");
  require_once("../Modelo/conexion2.php");
  $conexion = conect();
  $queryVisitas = mysqli_query($conexion, "select * from srcv_visitas where ESTATUS='1' and FECHA='$hoy'");
  $queryempresa = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='empresa' and ESTATUS='1'");
  $queryasunto = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='asunto' and ESTATUS='1'");
  ?>
  <!--aqui va la navbar-->
  <header>
    <nav class="navbar navbar-dark  fixed-top navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV SEGURIDAD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end navbar-custom" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h3 class="offcanvas-title tit-color" id="offcanvasDarkNavbarLabel"> Bienvenid@ <?php echo utf8_decode($row['NOMBRE']); ?> </h3>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesion</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <br>
  <br>
  <br>
  <br>
  <div class="mb-4"></div> <!--Salto de linea-->
  <h3 class="text-center">REGISTRO DE VISITAS</h3>
  <br><br>
  <?php
  date_default_timezone_set('America/Mexico_City');
  $fecha_actual = date("Y-m-d");
  $hora_actual = date("H:i");
  ?>

  <div class="container">
    <div class="row">
      <div class="col-md-9">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" style="background-color: #008B8B" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Nuevo Registro
      </button>
      </div>
    <!--Bucador-->
        <div class="col-md-3">
          <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
        </div>
      <div class="mb-3"></div><!--Salto de linea-->
      <!-- ALERTA -->
      <div class="mb-4"></div><!--Salto de linea-->
      <div id="mensaje">
        <?php echo $mensaje; ?>
      </div>
      <div class="mb-3"></div><!--Salto de linea-->

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
                    <label for="he" class="form-label">Hora de entrada </label>
                    <input type="time" disabled class="form-control" value="<?=$hora_actual?>" >
                    <input type="time" hidden class="form-control" id="he" name="he" value="<?= $hora_actual ?>" required>
                    <!--<div class="invalid-feedback">
                 Verifique los datos
                </div>-->
                  </div>

                  <div class="col">
                    <label for="fecha" class="form-label">Fecha *</label>
                    <input type="date" disabled class="form-control" value="<?=$fecha_actual?>" >
                    <input type="date" hidden class="form-control" id="fecha" name="fecha" value="<?= $fecha_actual ?>" required>
                    <!--<div class="invalid-feedback">
                 Verifique los datos
                </div>-->
                  </div>
                </div>

                <br>
                <div class="col">
                  <label for="nombre" class="form-label">Nombre *</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <div class="invalid-feedback">
                    Verifique los datos
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3"></div> <!-- Salto de línea -->
                    <label for="ap" class="form-label">Apellido Paterno *</label>
                    <input type="text" class="form-control" id="ap" name="ap" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>

                  <div class="col">
                    <div class="mb-3"></div> <!-- Salto de línea -->
                    <label for="am" class="form-label">Apellido Materno *</label>
                    <input type="text" class="form-control" id="am" name="am" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3"></div> <!-- Salto de línea -->
                    <label class="form-label" for="empresa">Empresa *</label><br>
                    <select class="form-select mr-sm-2" id="empresa" name="empresa" required>
                      <div class="invalid-feedback">
                        Verifique los datos
                      </div>
                      <option selected value="">Elige</option>
                      <!--Se muestran las opciones de EMPRESA 
               previamente registradas en la tabla listas-->
                      <?php
                      while ($filas = mysqli_fetch_assoc($queryempresa)) {
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
                    <label class="form-label" for="asunto">Asunto *</label><br>
                    <select class="form-select mr-sm-2" id="asunto" name="asunto" required>
                      <div class="invalid-feedback">
                        Verifique los datos
                      </div>
                      <option selected value="">Elige</option>
                      <!--Se muestran las opciones de ASUNTO
               previamente registradas en la tabla listas-->
                      <?php
                      while ($filas = mysqli_fetch_assoc($queryasunto)) {
                      ?>
                        <option value="<?php echo $filas['NOMBRE']; ?>">
                          <?php echo $filas['NOMBRE']; ?>
                        </option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                </div>
                <!--Botones para cancelar o enviar formulario del modal-->
                <div class="modal-footer">
                  <button type="button" onclick="limpiar()" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" onclick="validar()" >Confirmar</button>
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
            <thead class="table-dark">
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
                <tr class="datos">
                  <td>
                    <?php if(empty($filas['ENTRADA_SEGURIDAD'])){ ?>
                  <a href="../Controlador/controlador_entrada_seguridad.php?id=<?=$filas['ID_VISITA']?>"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                  <?php
                }else{
                   echo $filas['ENTRADA_SEGURIDAD'];
                   }?>
                  </td>
                  <td><?php echo $filas['FECHA'] ?></td>
                  <td><?php echo $filas['NOMBRE'] ?></td>
                  <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                  <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                  <td><?php echo $filas['EMPRESA'] ?></td>
                  <td><?php echo $filas['ASUNTO'] ?></td>
                  <td><?php echo $filas['SALIDA_SEGURIDAD'] ?></td>
                  <td>
                    <?php
                    if(empty($filas['SALIDA_SEGURIDAD'])){
                    ?>
                    <a href="../Controlador/controlador_editar_visitas.php?id=<?=$filas['ID_VISITA']?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    <?php
                    }else{echo "";}
                    ?>
                    <!--Boton de eliminar-->
                    <a href="../Controlador/controlador_eliminar_visita.php?id=<?=$filas['ID_VISITA']?>"><i class="fa fa-trash-o" aria-hidden="true" onclick="eliminar()" ></i></a>

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

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/validar_formulario.js" ></script>

  <script>

 //Script para validaciones
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

    function Visita(idVisita){
    document.getElementById('Visita_' + idVisita).value = idVisita;
    }


//Script de buscador
document.addEventListener('keyup', e =>{
    if(e.target.matches('#buscador')){
      document.querySelectorAll('.datos').forEach(dato =>{
        dato.textContent.toLowerCase().includes(e.target.value)
        ? dato.classList.remove('filtro')
        : dato.classList.add('filtro')
      }) 
    }
  })
  //fin del script de buscardor


//Script para mostrar alertas por determinado tiempo 
  document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el elemento de alerta
        var alerta = document.querySelector('.alert');

        // Verifica si se encontró el elemento de alerta
        if(alerta) {
            // Temporizador para eliminar la alerta después de 5 segundos (5000 milisegundos)
            setTimeout(function() {
                alerta.remove(); // Elimina la alerta del DOM
            }, 5000);
        }
    });
//Fin del  scripyt

</script>


<!--script para mostrar alerta de confirmación antes de cerrar sesión-->
<script>
  function cerrarsesion(event) {
    // Previene el comportamiento predeterminado del enlace
    event.preventDefault();

    // Muestra la alerta de SweetAlert
    swal("¿Estás seguro de que deseas cerrar sesión?", {
      buttons: ["Cancelar", "Aceptar"],
    }).then(function (confirmed) {
      // confirmed será true si se hace clic en "Aceptar", false si se hace clic en "Cancelar"
      if (confirmed) {
        // Realiza una solicitud Ajax al servidor para cerrar sesión
        $.ajax({
          type: "POST",
          url: "../Controlador/controlador_cerrar_sesion.php",
          //data: { key1: 'value1', key2: 'value2' },
          dataType: "json",
          success: function(response) {
            if (response.success) {
                // Redirige a otra interfaz después de cerrar la alerta (opcional)*/
                window.location.href = "../Vista/vista_inicio_sesion.php";
            } else {
              // Muestra una alerta de error con SweetAlert
              swal('Error', response.error, 'error');
            }
          }
        });
      }
    });
  }
</script>
</body>
</html>