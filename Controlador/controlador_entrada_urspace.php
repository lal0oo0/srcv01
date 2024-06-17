<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$usermodi= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
$id=$_GET['id'];
$hora_actual = date("H:i");

  $consulta="UPDATE srcv_visitas SET ENTRADA_URSPACE='$hora_actual', LAST_UPDATED_BY='$usermodi', LAST_UPDATE_DATE='$fechamodificacion' WHERE ID_VISITA='$id'";
  $sql=mysqli_query($conexion, $consulta);



if ($sql) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> La entrada ha sido confirmada correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error al confirmar la entrada.' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);
header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));


?>