<?php
require_once("../Modelo/conexion2.php");
$conexion = conect();

session_start();
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}

$ROL=$_SESSION['rol'];
// Verificar el rol del usuario
if ($ROL !== "seguridad") {
  // Si el usuario no tiene el rol correcto, redirigir a la página de inicio de sesión
  header("location: vista_inicio_sesion.php");
  exit();
}

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

  <title>Registrar</title>
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

  .botonconfirmar {
    background-color: #007bff; /*color boton de cerrar sesion */
  }

  
</style>

<body>
<?php
  date_default_timezone_set('America/Mexico_City');
  $hoy=date("Y-m-d");
  require_once("../Modelo/conexion2.php");
  $conexion = conect();
  $queryVisitas = mysqli_query($conexion, "SELECT * FROM srcv_visitas where ESTATUS='1' and FECHA='$hoy' ORDER BY ENTRADA_SEGURIDAD DESC");
  $queryempresa = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE CATEGORIA='empresa' and ESTATUS='1'");
  $queryasunto = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE CATEGORIA='asunto' and ESTATUS='1'");
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
      <button type="button" onclick="actualizarHora()" class="btn btn-primary" style="background-color: #008B8B" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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

                <div class="mb-2"></div> <!-- Salto de línea -->

                <div class="row">
                  <div class="col"></div>
                <div class="col-md-6 form-check">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" onchange="toggleGroupFields()">
                <label class="form-check-label" for="check">
                    Registrar grupo de visitas
                </label>
                </div> 
                  <div class="col"></div>
                </div>

                <div class="mb-3"></div> <!-- Salto de línea -->

                <div class="row">
                  <div class="col">
                    <label for="he" class="form-label">Hora de entrada </label>
                    <input type="time" id="hora_visible" disabled class="form-control" value="<?=$hora_actual?>" >
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
                  <label for="nombre" class="form-label" id="nombreLabel">Nombre *</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required>
                  <div class="invalid-feedback">
                    Verifique los datos
                  </div>
                </div>

                <div class="mb-2"></div> <!-- Salto de línea -->

                <div class="row align-items-center" id="personas" style="display: none;">
                  <div class="col"></div>
                <div class="col">
                  <label for="noPersonas" class="form-label">No. Personas *</label>
                  <input type="number" class="form-control" id="noPersonas" min="1" max="200" value="1" name="noPersonas" required>
                  <div class="invalid-feedback" id="person"></div>
                </div>
                <div class="col"></div>
                </div>
                

                <div class="row" id="apellidoFields">
                  <div class="col">
                    <div class="mb-3"></div> <!-- Salto de línea -->
                    <label for="ap" class="form-label">Apellido Paterno *</label>
                    <input type="text" class="form-control" id="ap" name="ap" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
                    <div class="invalid-feedback">
                      Verifique los datos
                    </div>
                  </div>

                  <div class="col">
                    <div class="mb-3"></div> <!-- Salto de línea -->
                    <label for="am" class="form-label">Apellido Materno *</label>
                    <input type="text" class="form-control" id="am" name="am" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required>
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
                      <!--Se muestran las opciones de EMPRESA previamente registradas en la tabla listas-->
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
                      <!--Se muestran las opciones de ASUNTO previamente registradas en la tabla listas-->
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
            <thead class="table-dark">
              <tr>
                <th scope="col">Hora de entrada</th>
                <th scope="col">Fecha</th>
                <th scope="col">Nombre/Grupo</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">No. Personas</th>
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
                if($filas['SALIDA_SEGURIDAD']=='00:00:00'){
                  $filas['SALIDA_SEGURIDAD'] = '';
                }
              ?>
                <tr class="datos">
                  <td>
                    <?php if(empty($filas['ENTRADA_SEGURIDAD'])){ ?>
                  <a href="../Controlador/controlador_entrada_seguridad.php?id=<?=$filas['ID_VISITA']?>" id="botonEntrada" class="btn btn-info btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Entrada
                  <i class="fa fa-sign-in" aria-hidden="true" style="font-size: 12px;"></i></a>
                  <?php
                }else{
                   echo $filas['ENTRADA_SEGURIDAD'];
                   }?>
                  </td>
                  <td><?php echo $filas['FECHA'] ?></td>
                  <td><?php
                  if(!$filas["ERROR_SALIDA"]){
                    echo $filas['NOMBRE']; 
                  }else{
                    echo'<i class="fa fa-exclamation-triangle" aria-hidden="true" id="advertencia" style="font-size: 12px"></i></a> '. $filas["NOMBRE"];
                  }
                  ?>
                   </td>
                  <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
                  <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
                  <td><?php echo $filas['NUMERO_PERSONAS'] ?></td>
                  <td><?php echo $filas['EMPRESA'] ?></td>
                  <td><?php echo $filas['ASUNTO'] ?></td>
                  <td><?php echo $filas['SALIDA_SEGURIDAD'] ?></td>
                  <td>
                    <?php
                    if(empty($filas['SALIDA_SEGURIDAD']) || $filas['SALIDA_SEGURIDAD']=='00:00:00'){
                    ?>
                    <a href="#" class="btn btn-info btn-sm" id="botonSalida" data-id="<?=$filas['ID_VISITA']?>" data-nombre="<?=$filas['NOMBRE']?>" data-bs-toggle="modal" data-bs-target="#salida" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Salida 
                    <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 12px;"></i></a>
                    <!-- Modal confirmación de salida-->
                    <div class="modal fade" id="salida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="labelConfirmarSalida"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="#" id="confirmarSalida" class="btn btn-primary">Confirmar</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }else{
                      ?>
                      <a href="../Controlador/controlador_advertencia_salida.php?id=<?=$filas['ID_VISITA']?>" class="btn btn-light btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black; border-color: #000000">Notificar 
                      <i class="fa fa-exclamation-triangle" aria-hidden="true" id="advertencia" style="font-size: 12px"></i></a>
                      <?php
                    }
                    ?>
                    <!--Boton de eliminar-->
                    <?php
                    if(empty($filas["ENTRADA_RECEPCION"]) && empty($filas["SALIDA_RECEPCION"]) && empty($filas["SALIDA_SEGURIDAD"]) && empty($filas["SALIDA_URSPACE"])){
                    ?>
                    
                    <a href="#" class="btn btn-danger btn-sm" id="botonEliminar" data-id="<?=$filas['ID_VISITA']?>" data-nombre="<?=$filas['NOMBRE']?>" data-bs-toggle="modal" data-bs-target="#eliminar" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Eliminar
                    <i class="fa fa-trash-o" aria-hidden="true" onclick="eliminar()" style="font-size: 12px;"></i>
                    </a>
    
                    <!-- Modal -->
                    <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="labelConfirmarEliminar"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="#" id="confirmarEliminar" class="btn btn-primary">Eliminar</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }else{
                      
                    }
                    ?>
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
  <!--script src="../js/validar_formulario.js" ></script-->
  <script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
  <script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->

<!-- JavaScript para manejar el ID dinámicamente del modal confirmación de salida -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  var modalSalida = document.getElementById('salida');
  var modalEliminar = document.getElementById('eliminar');
  var confirmarSalidaLink = document.getElementById('confirmarSalida');
  var confirmarEliminarLink = document.getElementById('confirmarEliminar');

  var textoConfirmarSalida = document.getElementById('labelConfirmarSalida');
  var textoConfirmarEliminar = document.getElementById('labelConfirmarEliminar');

  // Evento para el modal de salida
  modalSalida.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var visitaId = button.getAttribute('data-id');
    var visitaNombre = button.getAttribute('data-nombre');
    textoConfirmarSalida.textContent = '¿Deseas confirmar la salida de ' + visitaNombre + '?';
    confirmarSalidaLink.href = '../Controlador/controlador_editar_visitas.php?id=' + visitaId;
  });

  // Evento para el modal de eliminación
  modalEliminar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var visitaId = button.getAttribute('data-id');
    var visitaNombre = button.getAttribute('data-nombre');
    textoConfirmarEliminar.textContent = '¿Estás seguro de que deseas eliminar la visita de ' + visitaNombre + '?';
    confirmarEliminarLink.href = '../Controlador/controlador_eliminar_visita.php?id=' + visitaId;
  });
});
</script>
<script>
  document.getElementById('myForm').addEventListener('submit', function(event) {
  noPersonas = document.getElementById('noPersonas');
  if(noPersonas <= 1){
    document.getElementById('person').innerHTML = "El numero de personas debe ser mayor a 1";
    document.getElementById('noPersonas').classList.add('id-invalid');
    event.preventDefault();
  }
});

  // Crear tooltip para el botón 1
tippy('#botonEntrada', {
        content: 'Confirmar entrada',
        placement: 'bottom',
      });
// Crear tooltip para el botón 2
tippy('#botonSalida', {
        content: 'Confirmar salida',
        placement: 'bottom',
      });
// Crear tooltip para el botón 3
tippy('#botonEliminar', {
        content: 'Eliminar visita',
        placement: 'bottom',
      });
</script>

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
  //fin del script de buscador


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
      buttons: {
        cancel: "Cancelar",
        confirm: {
          text: "Aceptar",
          className: "botonconfirmar"
        }
      },
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    function capitalizeFirstLetter(input) {
        return input.replace(/(^|\s)\S/g, function(txt) {
            return txt.toUpperCase();
        });
    }

    document.getElementById('nombre').addEventListener('input', function() {
        var nombre = this.value.toLowerCase();
        nombre = capitalizeFirstLetter(nombre);
        this.value = nombre;
    });

    document.getElementById('ap').addEventListener('input', function() {
        var ap = this.value.toLowerCase();
        ap = capitalizeFirstLetter(ap);
        this.value = ap;
    });

    document.getElementById('am').addEventListener('input', function() {
        var am = this.value.toLowerCase();
        am = capitalizeFirstLetter(am);
        this.value = am;
    });
});
    // Función para actualizar la hora
    function actualizarHora() {
        var now = new Date();
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var currentTime = hours + ':' + minutes;
        $('#hora_actual_mostrar').val(currentTime);
        $('#he').val(currentTime);
    }

    // Escuchar el clic en el botón "Nuevo Registro" y actualizar la hora antes de abrir el modal
    $('#staticBackdrop').on('show.bs.modal', function (e) {
        actualizarHora();
    });
    $(document).ready(function() {
        // Cuando se muestra el modal, actualizar el campo visible con el valor del campo oculto
        $('#staticBackdrop').on('show.bs.modal', function (e) {
            // Obtener el valor del campo oculto
            var hora = $('#he').val();
            
            // Asignar el valor del campo oculto al campo visible
            $('#hora_visible').val(hora);
        });
    });

        //Limpiar fromulario
    function limpiar() {
    var formulario = document.getElementById('myForm');  
    // Resetear el formulario
    formulario.reset();
    location.reload();
}
function toggleGroupFields() {
  const checkbox = document.getElementById('flexCheckDefault');
  const apellidoFields = document.getElementById('apellidoFields');
  const noPersonasField = document.getElementById('personas');
  const apField = document.getElementById('ap');
  const amField = document.getElementById('am');
  const noPersonasInput = document.getElementById('noPersonas');
  const nombreLabel = document.getElementById('nombreLabel');
  const nombreInput = document.getElementById('nombre');

  if (checkbox.checked) {
    apellidoFields.style.display = 'none';
    noPersonasField.style.display = 'block';
    noPersonasField.required = true;
    apField.required = false;
    amField.required = false;
    noPersonasInput.required = true;
    nombreLabel.textContent = 'Grupo *';
    nombreInput.placeholder = 'Nombre del grupo';
    nombreInput.pattern = "^[A-Za-z0-9áéíóúü \W]{2,30}$";
  } else {
    apellidoFields.style.display = 'block';
    noPersonasField.style.display = 'none';
    noPersonasField.required = false;
    apField.required = true;
    amField.required = true;
    noPersonasInput.required = false;
    nombreLabel.textContent = 'Nombre *';
    nombreInput.placeholder = '';
    nombreInput.pattern = "^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$";
  }
}

</script>
</body>
</html>