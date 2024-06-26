<?php
session_start();

$CORREO=$_SESSION['correo'];
if (empty($_SESSION["correo"])){
  header("location: vista_inicio_sesion.php");
}

$ROL=$_SESSION['rol'];
// Verificar el rol del usuario
if ($ROL !== "recepcion") {
  // Si el usuario no tiene el rol correcto, redirigir a la página de inicio de sesión
  header("location: vista_inicio_sesion.php");
  exit();
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
    
    <title>Historial de visitas</title>
</head>
<style>

   .navbar-custom {
    background-color: #64BAFF; /* Darle color al NAV, del color que se necesite */
    font-size: 18px; /* Hacer las letras más grandes */
  }

  thead{/*EStilos para la cabecera fija de la tabla*/
    position: sticky;
    top:0;
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
  height: 400px;
  overflow: auto;
  }
  .table-wrapper-scroll-y {
  display: block;
  }

  .tit-color{
    color: white;
  }

  .highlight-container {/* Estilos para resaltar el contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Agrega una sombra al contenedor */
    padding: 15px; /* Añade un relleno al contenedor para separarlo visualmente */
    margin-bottom: 20px; /* Agrega un margen inferior al contenedor */
  }

  .filtro{
    display: none;
  }
  .botones{
    display: none;
  }

  .botonconfirmar {
    background-color: #007bff; /*color boton de cerrar sesion */
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    date_default_timezone_set('America/Mexico_City');
    $hoy=date("Y-m-d");
    $query = mysqli_query ($conexion, "SELECT * FROM srcv_visitas WHERE ESTATUS= '1' AND FECHA='$hoy' ORDER BY FECHA DESC, ENTRADA_SEGURIDAD DESC");


  ?>
 
 <header>
  <nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" id="actualizarPagina" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV RECEPCIÓN</a>
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
            <a class="nav-link active" href="../Controlador/controlador_cerrar_sesion.php" onclick="cerrarsesion(event)">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</header>
<br><br><br><br><br>
<h3 class="text-center">HISTORIAL DE VISITAS</h3> 
<div class="mb-5"></div> <!--Salto de linea-->
<!-- ALERTA -->
<div class="mb-4"></div> <!--Salto de linea-->
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" id="mensaje">
    <?php echo $mensaje; ?>
  </div>
  <div class="col md-1"></div>
</div>

<div class="mb-3"></div><!--Salto de linea-->
<div class="container">

<!--Bucador-->
    <div class="row">
      <div class="col-md-9"></div>
      <div class="col-md-3">
      <input class="form-control mr-sm-2" type="search" id="buscador" name="buscador" placeholder="Buscar" aria-label="Search" style="border: 1px solid rgba(0, 0, 0, 0.7);">
      </div>
    </div>

  <div class="mb-3"></div><!--Salto de linea-->
  <div class="row">
    <div class="col-*-*">
    <div class="table-responsive my-custom-scrollbar">
  <!-- Estos son datos de ejemplo -->
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
        <th scope="col">Piso</th>
        <th scope="col">Hora de salida</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
      while ($filas = mysqli_fetch_assoc($query)) {
        $idRegistro=$filas["ID_VISITA"];
        $idForm='myForm_' . $idRegistro;
        if($filas['SALIDA_SEGURIDAD'] == '00:00:00'){
          $filas['SALIDA_SEGURIDAD']='';
        }

      ?>
      <tr class="datos">
          <td><?php echo $filas['ENTRADA_SEGURIDAD'] ?></td>
          <td><?php echo $filas['FECHA'] ?></td>
          <td><?php echo $filas['NOMBRE'] ?></td>
          <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
          <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
          <td><?php echo $filas['NUMERO_PERSONAS'] ?></td>
          <td><?php echo $filas['EMPRESA'] ?></td>
          <td><?php echo $filas['ASUNTO'] ?></td>
          <td><?php echo $filas['PISO'] ?></td>
          <td><?php echo $filas['SALIDA_SEGURIDAD'] ?></td>
          <td>
            <!----Aqui van los botones de acciones---->
                  <!--Boton para confirmar entrada-->
                    <?php
                    if(empty($filas['ENTRADA_RECEPCION']) && empty($filas['ENTRADA_URSPACE']) && empty($filas['SALIDA_SEGURIDAD'])){
                    ?>
                    <a href="../Controlador/controlador_entrada_recepcion.php?id=<?=$filas['ID_VISITA']?>" id="botonEntrada" class="btn btn-info btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Entrada 
                    <i class="fa fa-sign-in" aria-hidden="true" style="font-size: 12px;"></i></a>
                    <?php
                    }else{ //Aqui desaparece el botón 
                    }

                    ///Desaparecer boton de modificar 
                    if(empty($filas["SALIDA_RECEPCION"]) && empty($filas['SALIDA_SEGURIDAD'])){
                    ?>

                 <!-- Modificar visitas -->
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_VISITA'] ?>" id="botonModificar" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Modificar 
                  <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 12px;"></i></a>
                  <!-- Modal para modificar visitas-->
                  <div class="modal fade" id="exampleModal_<?php echo $filas['ID_VISITA'] ?>"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar visita de <?= $filas['NOMBRE'] ?></h1>
                          <input id="visita_<?php echo $filas['ID_VISITA'] ?>" name="visita" value="" type="hidden">
                          <input type="hidden" name="idvisita" id="idvisita" value="<?php echo $filas['ID_VISITA'] ?>">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3"></div> <!--Salto de linea-->
                        <!--modificar visitas-->
                        <div class="modal-body">
                          <form action="../Controlador/controlador_modificar_visita.php" class="formulario row g-3 needs-validation" name="<?php echo $idForm; ?>" id="<?php echo $idForm; ?>" method="post" novalidate>
                              <input type="hidden" name="idvisita" value="<?= $filas['ID_VISITA'] ?>">
                              <div class="col">
                                <label for="se">Nombre *</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?=$filas['NOMBRE']?>" placeholder="Nombre" aria-label="nombre" aria-describedby="basic-addon1" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü \W]{3,30}$" required oninput="capitalizeFirstLetter(this)">
                                <div class="invalid-feedback">
                                  Verifique los datos
                                </div>
                              </div>
                              <div class="mb-2"></div> <!--Salto de linea-->

                              <div class="row">
                                <div class="col">
                                  <label for="se">Apellido paterno *</label>
                                  <input type="text" class="form-control" name="apellidopaterno" id="pellidopaterno" value="<?=$filas['APELLIDO_PATERNO']?>" placeholder="Apellido paterno" aria-label="Apellido paterno" aria-describedby="basic-addon1" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required oninput="capitalizeFirstLetter(this)">
                                  <div class="invalid-feedback">
                                    Verifique los datos
                                  </div>
                                </div>
                                <div class="col">
                                  <label for="se">Apellido materno *</label>
                                  <input type="text" class="form-control" name="apellidomaterno" id="apellidomaterno" placeholder="Apellido materno" value="<?=$filas['APELLIDO_MATERNO']?>" aria-label="Apellido materno" aria-describedby="basic-addon1" pattern="^(?=.*[a-záéíóúü])(?=.*[A-ZÁÉÍÓÚÜ])[A-Za-záéíóúü\W]{3,30}$" required oninput="capitalizeFirstLetter(this)">
                                  <div class="invalid-feedback">
                                    Verifique los datos
                                  </div>
                                </div>
                              </div>
                              <div class="mb-2"></div> <!--Salto de linea-->
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3"></div> <!-- Salto de línea -->
                                  <label class="form-label" for="empresa">Empresa *</label><br>
                                <?php
                                    $conexion = conect();

                                    $queryEmpr= mysqli_query($conexion,"SELECT NOMBRE FROM srcv_listas WHERE CATEGORIA = 'Empresa' and ESTATUS = '1';");
                                    //$result_empresa= mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='Empresa' and ESTATUS='1'");
                                ?>
                                    <select class="form-select mr-sm-2" id="empresa" name="empresa" required="" title="Selecciona una empresa ">
                                        <option value="">Selecciona una empresa</option>
                                        <?php
                                            while($datosEmp = mysqli_fetch_array($queryEmpr)){
                                        ?>
                                        <option value="<?php echo $datosEmp['NOMBRE']?>" <?php if($filas['EMPRESA'] == $datosEmp['NOMBRE']) echo "selected"; ?>><?php echo $datosEmp['NOMBRE'];?></option>
                                        <?php
                                            }
                                            $conexion->close();
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col">
                                  <div class="mb-3"></div> <!-- Salto de línea -->
                                  <label class="form-label" for="asunto">Asunto *</label><br>

                                <?php
                                    $conexion = conect();

                                    $queryAsun= mysqli_query($conexion,"SELECT NOMBRE FROM srcv_listas WHERE CATEGORIA = 'Asunto' and ESTATUS = '1';");
                                ?>
                                    <select class="form-select mr-sm-2" id="asunto" name="asunto" required="" title="Selecciona el asunto ">
                                        <option value="" >Selecciona el asunto</option>
                                        <?php
                                            while($datosAsun = mysqli_fetch_array($queryAsun)){
                                        ?>
                                        <option value="<?php echo $datosAsun['NOMBRE']?>" <?php if($filas['ASUNTO'] == $datosAsun['NOMBRE']) echo "selected"; ?>><?php echo $datosAsun['NOMBRE'];?></option>
                                        <?php
                                            }
                                            $conexion->close();
                                        ?>
                                    </select>
                                </div>
                              </div>
                              <div class="mb-3"></div> <!-- Salto de línea -->
                              <div class="row">
                              <label class="form-label" for="asunto">Piso *</label><br>
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <?php
                                    $conexion = conect();

                                    $queryPiso= mysqli_query($conexion,"SELECT NOMBRE FROM srcv_listas WHERE CATEGORIA = 'Piso' and ESTATUS = '1';");
                                ?>
                                    <select class="form-select mr-sm-2" id="piso" name="piso" required="" title="Selecciona el piso ">
                                        <option value="" >Selecciona el piso</option>
                                        <?php
                                            while($datosPiso = mysqli_fetch_array($queryPiso)){
                                        ?>
                                        <option value="<?php echo $datosPiso['NOMBRE']?>" <?php if($filas['PISO'] == $datosPiso['NOMBRE']) echo "selected"; ?>><?php echo $datosPiso['NOMBRE'];?></option>
                                        <?php
                                            }
                                            $conexion->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3"></div>
                              </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Confirmar</button>
                              <button type="button" class="btn btn-secondary" onclick="limpiar('<?php echo $idForm; ?>')" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    } else{/*No imprime nada*/}
                  ?>
                    <!--Boton para confirmar salida aparece solo si ya confirmaron entrada-->
                    <?php
                    // Obtener los valores actuales para depuración
                    $salidaRecepcion = $filas['SALIDA_RECEPCION'];
                    $entradaRecepcion = $filas['ENTRADA_RECEPCION'];
                    $entradaUrspace = $filas['ENTRADA_URSPACE'];
                    $salidaUrspace = $filas['SALIDA_URSPACE'];
                    $salidaSeguridad = $filas['SALIDA_SEGURIDAD'];

                    /* Imprimir valores para depuración
                    echo "SALIDA_RECEPCION: " . (empty($salidaRecepcion) ? "empty" : "not empty") . "<br>";
                    echo "ENTRADA_RECEPCION: " . (empty($entradaRecepcion) ? "empty" : "not empty") . "<br>";
                    echo "ENTRADA_URSPACE: " . (empty($entradaUrspace) ? "empty" : "not empty") . "<br>";
                    echo "SALIDA_URSPACE: " . (empty($salidaUrspace) ? "empty" : "not empty") . "<br>";
                    echo "SALIDA_SEGURIDAD: " . (empty($salidaSeguridad) ? "empty" : "not empty") . "<br>";*/

                    // Inicializar variable para ocultar el botón
                    $hideButton = false;

                    // Comprobar cada condición por separado
                    if (!empty($entradaRecepcion) && !empty($entradaUrspace) && empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (empty($entradaRecepcion) && !empty($entradaUrspace) && empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (!empty($entradaRecepcion) && empty($entradaUrspace) && !empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (empty($entradaRecepcion) && empty($entradaUrspace) && !empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (!empty($entradaRecepcion) && !empty($entradaUrspace) && !empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (empty($entradaRecepcion) && !empty($entradaUrspace) && !empty($salidaUrspace) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    // Para clientes que pasan solo por seguridad y recepción
                    if (empty($entradaUrspace) && empty($salidaUrspace) && !empty($entradaRecepcion) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }

                    if (empty($entradaUrspace) && empty($salidaUrspace) && empty($entradaRecepcion) && !empty($salidaSeguridad)) {
                        $hideButton = true;
                    }
                    if (empty($entradaRecepcion) && empty($entradaUrspace) && empty($salidaUrspace) && empty($salidaSeguridad)) {
                        $hideButton = true;
                    }
                    if(!empty($salidaRecepcion)){
                      $hideButton = true;
                    }
                    // Mostrar el botón si no se debe ocultar
                    if (!$hideButton) {
                    ?>
                      <a href="#" id="botonSalida" data-id="<?=$filas['ID_VISITA']?>" data-nombre="<?=$filas['NOMBRE']?>" data-bs-toggle="modal" data-bs-target="#salida" class="btn btn-info btn-sm" style="font-size: 10px; padding: 2px 5px; height: 20px; line-height: 1; color: black;">Salida 
                      <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 14px;"></i></a>
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
<div class="mb-4"></div> 
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-5"></div>
    <div class="col-sm-12 col-md-7 highlight-container">
      <form action="../PhpSpreadsheet/reporte_visitas.php" method="post">
        <div class="row">
          <div class="col-sm-4">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
          </div>
          <div class="col-sm-4">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
          </div>
          <div class="col-sm-4 d-flex align-items-center justify-content-center"> <!-- Modificado para centrar el botón verticalmente -->
            <button type="submit" class="btn btn-dark tit-color" style="background-color:#008000; width: 150px;"> <!-- Ajusta el ancho del botón según tus necesidades -->
              <img src="../imagenes/excel.png" width="20px">Informe
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="mb-2"></div> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script><!-- Script para crear tippy-->
<script src="https://unpkg.com/tippy.js@6"></script><!-- Script para crear tippy-->

<!-- JavaScript para manejar el ID dinámicamente -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalSalida = document.getElementById('salida');
    var confirmarSalidaLink = document.getElementById('confirmarSalida');
    var textoConfirmarSalida = document.getElementById('labelConfirmarSalida');

    modalSalida.addEventListener('show.bs.modal', function (event) {
      // Botón que activó el modal
      var button = event.relatedTarget;
      // Extraer información de los atributos data-* 
      var visitaId = button.getAttribute('data-id');
      var visitaNombre = button.getAttribute('data-nombre');
      //Mostrar texto de confirmación mas el nombre de la visita
      textoConfirmarSalida.textContent = '¿Deseas confirmar la salida de ' + visitaNombre + '?';
      // Actualizar el enlace de confirmación con el ID correcto
      confirmarSalidaLink.href = '../Controlador/controlador_salida_recepcion.php?id=' + visitaId;
    });
  });
</script>
<script>
  //Limpiar fromulario
  function limpiar(idForm) {
      var formulario = document.getElementById(idForm);
      // Resetear el formulario
      formulario.reset();
    }

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
tippy('#botonModificar', {
        content: 'Modificar visita',
        placement: 'bottom',
      });
</script>

<script>
  //SCRIPT PARA VALIDACIONES
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


  //Script para poner por tiempos las alertas de bootstrap

  // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el elemento de alerta
        var alerta = document.querySelector('.alert');

        // Verifica si se encontró el elemento de alerta
        if(alerta) {
            // Temporizador para eliminar la alerta después de 4 segundos (4000 milisegundos)
            setTimeout(function() {
                alerta.remove(); // Elimina la alerta del DOM
            }, 4000);
        }
    });
  //Fin del script

  ///Script para recargar pagina
  document.getElementById("actualizarPagina").addEventListener("click", function() {
            // Al hacer clic en el botón, recargamos la página
            location.reload();
        });
  ///Fin del script
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

    document.getElementById('pellidopaterno').addEventListener('input', function() {
        var apellidopaterno = this.value.toLowerCase();
        apellidopaterno = capitalizeFirstLetter(apellidopaterno);
        this.value = aapellidopaterno;
    });

    document.getElementById('apellidomaterno').addEventListener('input', function() {
        var apellidomaterno = this.value.toLowerCase();
        apellidomaterno = capitalizeFirstLetter(apellidomaterno);
        this.value = apellidomaterno;
    });
});
</script>
</body>
</html>
