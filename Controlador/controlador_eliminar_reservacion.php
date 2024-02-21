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
$id=$_GET["id"];
////////////  AQUI ESTAS CONSULTAS ERAN PARA RECUPERAR EL ID DE UNA SALA DE UNA RESERVACION
 // $sala="SELECT ID_SALA FROM srcv_reservaciones WHERE ID_RESERVACION='$id'";
  //$idsala=mysqli_query($conexion, $sala);
  $sql = "UPDATE srcv_reservaciones SET USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion', ESTATUS='0' where ID_RESERVACION='$id'";
  //$desocupar = "UPDATE srcv_salas SET RESERVADA='0', USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion' WHERE ID_SALA='$idsala'";
  //$desocupada = mysqli_query($conexion,$desocupar);
  $resultado=mysqli_query($conexion,$sql);

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