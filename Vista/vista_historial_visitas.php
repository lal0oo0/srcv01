<?php
session_start();
$ROL=$_SESSION['rol'];
$CORREO=$_SESSION['correo'];
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
  .filtro{
    display: none;
  }
  .botones{
    display: none;
  }
</style>

<body>
<?php
    require_once("../Modelo/conexion2.php");
    $conexion = conect();
    $query = mysqli_query ($conexion, "select * from srcv_visitas");
    $empresa = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='Empresa' and ESTATUS='1'");
    $asunto = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='Asunto' and ESTATUS='1'");
    $piso = mysqli_query($conexion, "select * from srcv_listas WHERE CATEGORIA='Piso' and ESTATUS='1'");
  ?>
 
 <header>
  <nav class="navbar navbar-dark  fixed-top navbar-custom" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../imagenes/yyj.png" width="120px"> SRCV RECEPCIÓN</a>
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
        <th scope="col">Nombre</th>
        <th scope="col">Apellido Paterno</th>
        <th scope="col">Apellido Materno</th>
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
      ?>
      <tr class="datos">
          <td><?php echo $filas['ENTRADA_SEGURIDAD'] ?></td>
          <td><?php echo $filas['FECHA'] ?></td>
          <td><?php echo $filas['NOMBRE'] ?></td>
          <td><?php echo $filas['APELLIDO_PATERNO'] ?></td>
          <td><?php echo $filas['APELLIDO_MATERNO'] ?></td>
          <td><?php echo $filas['EMPRESA'] ?></td>
          <td><?php echo $filas['ASUNTO'] ?></td>
          <td><?php echo $filas['PISO'] ?></td>
          <td><?php echo $filas['SALIDA_SEGURIDAD'] ?></td>
          <td>
                  <!-- Modificar reservaciones -->
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $filas['ID_VISITA'] ?>"> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                  <!-- Modal para modificar reservaciones-->
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
                        <!--posponer reservaciones-->
                        <div class="modal-body">
                          <form action="../Controlador/controlador_modificar_visita.php" class="formulario row g-3 needs-validation" method="post" novalidate>
                              <input type="hidden" name="idvisita" value="<?= $filas['ID_VISITA'] ?>">
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3"></div> <!-- Salto de línea -->
                                  <label class="form-label" for="empresa">Empresa *</label><br>
                                  <select class="form-select mr-sm-2" id="empresa" name="empresa">
                                    <div class="invalid-feedback">
                                      Verifique los datos
                                    </div>
                                    <option selected value=""><?=$filas['EMPRESA']?></option>
                                    <?php
                                    while ($fila_empresa = mysqli_fetch_assoc($empresa)) {
                                    ?>
                                      <option value="<?php echo $fila_empresa['NOMBRE']; ?>">
                                        <?php echo $fila_empresa['NOMBRE']; ?>
                                      </option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                
                                <div class="col">
                                  <div class="mb-3"></div> <!-- Salto de línea -->
                                  <label class="form-label" for="asunto">Asunto *</label><br>
                                  <select class="form-select mr-sm-2" id="asunto" name="asunto">
                                    <div class="invalid-feedback">
                                      Verifique los datos
                                    </div>
                                    <option selected value=""><?=$filas['ASUNTO']?></option>
                                    <?php
                                    while ($fila_asunto = mysqli_fetch_assoc($asunto)) {
                                    ?>
                                      <option value="<?php echo $fila_asunto['NOMBRE']; ?>">
                                        <?php echo $fila_asunto['NOMBRE']; ?>
                                      </option>
                                      <?php
                                        }
                                      ?>
                                  </select>
                                </div>
                              </div>
                              <div class="mb-3"></div> <!-- Salto de línea -->
                              <div class="row">
                              <label class="form-label" for="asunto">Piso *</label><br>
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                  <select class="form-select mr-sm-2" id="ubicacion" name="ubicacion" required>
                                      <div class="invalid-feedback">
                                        Verifique los datos
                                      </div>
                                      <option selected value="">Selecciona</option>
                                      <?php
                                        while ($fila_piso = mysqli_fetch_assoc($piso)) {
                                      ?>
                                      <option value="<?php echo $fila_piso['NOMBRE']; ?>">
                                        <?php echo $fila_piso['NOMBRE']; ?>
                                      </option>
                                      <?php
                                        }
                                      ?>
                                  </select>
                                </div>
                                <div class="col-md-3"></div>
                              </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Confirmar</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>



                    <?php
                    if(empty($filas['ENTRADA_RECEPCION'])){
                    ?>
                    <a href="../Controlador/controlador_entrada_recepcion.php?id=<?=$filas['ID_VISITA']?>"><i class="fa fa-sign-in" aria-hidden="true"></i></a> |
                    <?php
                    }else{
                    ?>
                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($filas['SALIDA_RECEPCION'])){
                    ?>
                    <a href="../Controlador/controlador_salida_recepcion.php?id=<?=$filas['ID_VISITA']?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    <?php
                    }else{
                    ?>
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
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
<div class="mb-1"></div> 
<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-6 shadow p-3 mb-5 bg-body-tertiary rounded">
    <form action="../PhpSpreadsheet/reporte_administracion.php" method="post">
      <label for="fecha_inicio">Fecha de inicio:</label>
      <input type="date" id="fecha_inicio" name="fecha_inicio">

      <label for="fecha_fin">Fecha de fin:</label>
      <input type="date" id="fecha_fin" name="fecha_fin">
      
      <button type="submit" class="btn btn-dark tit-color" style="background-color:#008000">
        <img src="../imagenes/excel.png" width="20px">Informe
      </button>
    </form>
  </div>
  <div class="col-md-1"></div>
</div>
<div class="mb-1"></div> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!--sweetalert sea local-->
<script src="../js/jquery-3.1.1.min.js"></script> <!-- Abra y cierre el menú -->
<script src="../js/bootstrap.bundle.min.js"></script>
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