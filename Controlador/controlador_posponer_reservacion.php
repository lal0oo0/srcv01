<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$usermodi = $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();


// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
/*Para capturar los campos*/
$variable = $_POST['id'];
$variable1 = $_POST['Fechainicio'];
$variable2 = $_POST['Fechafinalizacion'];
$variable3 = $_POST['Horainicio'];
$variable4 = $_POST['Horafinalizacion'];
$variable5 = $_POST['Total'];
$variable6 = $_POST['enganche'];
$variableab = $_POST['Abono'];
// Eliminar el símbolo de la moneda y otros caracteres no numéricos
$variable8 = floatval(preg_replace('/[^0-9.]/', '', $variableab));
$variableSuma= $variable6+$variable8;
$idSala = $_POST['idsala'];

if(($variable7 = intval($variable5)-intval($variableSuma))<0){
  $mensaje = '<div class="alert alert-danger" role="alert">Error al registrar cambios: No se puede abonar una cantidad mayor al total</div>';
}else{

  $reservaciones = mysqli_query($conexion, "SELECT * FROM srcv_reservaciones WHERE ID_SALA = '$idSala' AND FECHA_ENTRADA = '$variable1' AND HORA_ENTRADA <= '$variable4' AND HORA_SALIDA >= '$variable3'");
  $resenCurso = mysqli_num_rows($reservaciones);
  $filas  = mysqli_fetch_assoc($reservaciones);
  if ($resenCurso < 1 || $resenCurso > 0 && $filas['ID_RESERVACION'] == $variable && $filas['FECHA_ENTRADA'] == $variable1 && $filas['FECHA_SALIDA'] == $variable2 && $filas['HORA_ENTRADA'] == $variable3 && $filas['HORA_SALIDA'] == $variable4 || $resenCurso == 1 && $filas['ID_RESERVACION'] == $variable) {
    $consulta="UPDATE srcv_reservaciones SET LAST_UPDATED_BY ='$usermodi', LAST_UPDATE_DATE ='$fechamodificacion', FECHA_ENTRADA='$variable1', FECHA_SALIDA='$variable2', HORA_ENTRADA='$variable3', HORA_SALIDA='$variable4', ENGANCHE='$variableSuma', LIQUIDACION='$variable7' WHERE ID_RESERVACION='$variable'";
    $sql=mysqli_query($conexion, $consulta);
  

    if ($sql) {
        // Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> El registro se ha guardado correctamente
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else {
        // Error: alerta de Bootstrap error con detalles
        $mensaje = '<div class="alert alert-danger" role="alert">Error al registrar cambios: ' . mysqli_error($conexion) . '</div>';
    }
  } else {
    $mensaje = '<div class="alert alert-danger" role="alert">Ya existe una reservación en este espacio durante el horario seleccionado</div>';
}
    mysqli_close($conexion);}
    
    header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));
  
    
    ?>