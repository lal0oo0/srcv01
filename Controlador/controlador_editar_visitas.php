<?php

session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidop = $_POST['ap'];
$apellidom = $_POST['am'];
$hora_salida = $_POST['hs'];
//$id_visita= '';

/*Codigo para guardar un registro temporalmente en una variable php
$visita = "INSERT INTO srcv_visitas(ID_VISITA, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, USUARIO_ALTA, USUARIO_MODIFICACION, ESTATUS) 
VALUES ('$id','$nombre','$apellidop','$apellidom','$usuariom','$usuariom','1')";
Para ejecutar la consulta
$ejecutar = mysqli_query($conexion, $visita); */


  $consulta="UPDATE srcv_visitas SET NOMBRE='$nombre', APELLIDO_PATERNO='$apellidop',
  APELLIDO_MATERNO='$apellidom',HORA_SALIDA='$hora_salida',USUARIO_MODIFICACION='$usuariom'
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