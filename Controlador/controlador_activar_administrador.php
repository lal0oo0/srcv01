<?php
session_start();
$usermodi = $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
$id=$_GET["id"];


  $sql = "UPDATE srcv_administradores SET CREATED_BY='$usermodi', LAST_UPDATED_BY='$fechamodificacion', ESTATUS='1' WHERE ID_ADMINISTRADOR='$id'";
  $resultado=mysqli_query($conexion,$sql);


/*cambiar alertas*/
    if ($resultado) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El usuario se ha activado correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error al activar al usuario.' . mysqli_error($conexion) . '</div>';
    }
mysqli_close($conexion);

header("location: ../Vista/vista_registro_administradores.php?mensaje=" . urlencode($mensaje));

?>