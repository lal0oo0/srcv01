<?php
session_start();
$usermodi= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();


// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
//Para capturar los campos
$id = $_GET['id'];


  $borrar="UPDATE srcv_reservaciones SET USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion', USO='1' WHERE ID_RESERVACION='$id' AND LIQUIDACION='0'";
  $sql=mysqli_query($conexion, $borrar);



if ($borrar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> La reservación ha sido finalizada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error al confirmar la finalización de la reservación.' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);
header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));


?>