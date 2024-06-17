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
$id=$_GET["id"];

  $sql = "UPDATE srcv_reservaciones SET LAST_UPDATED_BY='$usermodi', LAST_UPDATE_DATE='$fechamodificacion', ESTATUS='0' WHERE ID_RESERVACION='$id'";
  $resultado=mysqli_query($conexion,$sql);

//Consulta para eliminar la reservacion de la tabla de visitas si la reservación se canceló
  $sql_visitas = "DELETE FROM srcv_visitas WHERE ID_VISITA='$id'";
  $resultado_visitas=mysqli_query($conexion,$sql_visitas);


/*cambiar alertas*/
    if ($resultado) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> La reservación ha sido cancelada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error al cancelar la reservación' . mysqli_error($conexion) . '</div>';
    }
mysqli_close($conexion);

header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));

?>