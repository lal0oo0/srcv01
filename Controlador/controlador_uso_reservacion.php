<?php

session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$id = $_GET['id'];


  $borrar="UPDATE srcv_reservaciones SET USUARIO_MODIFICACION='$usuariom', FECHA_MODIFICACION='NOW', USO='1' WHERE ID_RESERVACION='$id'";
  $sql=mysqli_query($conexion, $borrar);



if ($borrar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> Se ha confirmado la salida del cliente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);
header("location: ../Vista/vista_historial_reservaciones.php?mensaje=" . urlencode($mensaje));


?>