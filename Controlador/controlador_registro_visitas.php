<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$usuariom= $_SESSION['correo'];
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

date_default_timezone_set('America/Mexico_City');
// Generar un identificador único basado en la fecha y hora actual
$id_unico = (new DateTime())->format('YmdHis');
// Obtén la fecha y hora actual
$fechaAlta = date('Y-m-d H:i:s');

/*Para capturar los campos*/
$he = $_POST['he'];
$fecha = $_POST['fecha'];
$nombre = $_POST['nombre'];
$apellidop = $_POST['ap'];
$apellidom = $_POST['am'];
$empresa = $_POST['empresa'];
$asunto = $_POST['asunto'];


//y$variable11= $_POST['salaSeleccionada'];
/*Codigo para guardar un registro temporalmente en una variable php*/
$visita = "INSERT INTO srcv_visitas(ID_VISITA, ENTRADA_SEGURIDAD, FECHA, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, EMPRESA, ASUNTO, FECHA_ALTA, FECHA_MODIFICACION, USUARIO_ALTA, USUARIO_MODIFICACION, ESTATUS) 
VALUES ('$id_unico', '$he', '$fecha','$nombre','$apellidop','$apellidom','$empresa','$asunto', '$fechaAlta', '$fechaAlta', '$usuariom','$usuariom','1')";
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