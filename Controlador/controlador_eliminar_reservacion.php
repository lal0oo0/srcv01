<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

    $id=$_GET["id"];
    $sql = "UPDATE srcv_reservaciones SET ESTATUS='0' where ID_RESERVACION='$id'";
    $resultado=mysqli_query($conexion,$sql);

    if ($resultado) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El registro se ha Eliminado correctamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
    }
mysqli_close($conexion);

header("location: ../Vista/vista_historial_reservaciones.php?mensaje=" . urlencode($mensaje));

?>