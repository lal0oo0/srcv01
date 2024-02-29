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
$id=$_GET['id'];
$hora_actual = date("H:i");


// Verificar si la hora de entrada no ha sido confirmada entonces no se puede confirmar la hora de salida
$verificarhora = "SELECT ENTRADA_URSPACE FROM srcv_visitas WHERE ID_VISITA='$id'";
$resultado = mysqli_query($conexion, $verificarhora);
$fila = mysqli_fetch_assoc($resultado);

if (empty($fila['ENTRADA_URSPACE'])) {
  // Mostrar mensaje de reservación no finalizada
  $mensaje = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> La hora de salida no se puede confirmar hasta que se confirme la hora de entrada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
} else {
  // Actualizar si la hora de entrada ya se confirmo
  $consulta="UPDATE srcv_visitas SET SALIDA_URSPACE ='$hora_actual', USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion' WHERE ID_VISITA='$id'";
  $sql=mysqli_query($conexion, $consulta);

  if ($sql) {
      // Éxito: alerta de Bootstrap éxito
      $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Éxito!</strong> La hora de salida ha sido confirmada.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
  } else {
      // Error: alerta de Bootstrap error con detalles
      $mensaje = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Error al confirmar la hora de salida.' . mysqli_error($conexion) . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
  }
}


mysqli_close($conexion);
header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));


?>