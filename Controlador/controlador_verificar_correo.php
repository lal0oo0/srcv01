<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Recibir datos del formulario
$correo = $_POST['correo'];

//Consulta para verificar si correo existe
$sql =  (" SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo' ");
$result=$conexion->query($sql);

if ($result->num_rows==1) {
    $_SESSION['correo'] = $correo;
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> Correo electronico encontrado.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
   header("Location: ../Vista/vista_recuperar_contrasena_pregunta.php?mensaje=" . urlencode($mensaje));
    exit();
}else{
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">
    <strong>Error!</strong> Error verifique su correo.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>' ;
    header("Location: ../Vista/vista_verificar_correo.php?mensaje=" . urlencode($mensaje));
    exit();
}

mysqli_close($conexion);

?>