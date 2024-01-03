<?php
session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$id = $_POST['idVisita'];
$nombre = $_POST['nombre'];
$apellidop = $_POST['ap'];
$apellidom = $_POST['am'];
$hora_salida = $_POST['hs'];


/*Codigo para guardar un registro temporalmente en una variable php*/
$visita = "INSERT INTO srcv_visitas(NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, USUARIO_ALTA, USUARIO_MODIFICACION, ESTATUS) 
VALUES ('$nombre','$apellidop','$apellidom','$usuariom','$usuariom','1')";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $visita); 


if ($ejecutar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El registro se ha guardado correctamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);

header("location: ../Vista/vista_registro_visitas.php?mensaje=" . urlencode($mensaje));


?>