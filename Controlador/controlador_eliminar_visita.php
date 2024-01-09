<?php

session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$id = $_GET['id'];


  $borrar="UPDATE srcv_visitas SET USUARIO_MODIFICACION='$usuariom', FECHA_MODIFICACION='', ESTATUS='0' WHERE ID_VISITA='$id'";
  $sql=mysqli_query($conexion, $borrar);



if ($borrar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El registro se ha eliminado correctamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);
header("location: ../Vista/vista_registro_visitas.php?mensaje=" . urlencode($mensaje));


?>