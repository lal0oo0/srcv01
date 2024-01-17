<?php

session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();
$id=$_GET['id'];

date_default_timezone_set('America/Mexico_City');
$hora_actual = date("H:i");

  $consulta="UPDATE srcv_visitas SET HORA_SALIDA='$hora_actual',USUARIO_MODIFICACION='$usuariom'
  WHERE ID_VISITA='$id'";
  $sql=mysqli_query($conexion, $consulta);



if ($sql) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El registro se ha actualizado correctamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);
header("location: ../Vista/vista_registro_visitas.php?mensaje=" . urlencode($mensaje));


?>