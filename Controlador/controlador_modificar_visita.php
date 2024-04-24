<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$usermodi = $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();


// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
/*Para capturar los campos*/
$id = $_POST['idvisita'];
$nombre = $_POST['nombre'];
$apellidopa = $_POST['apellidopaterno'];
$apellidoma = $_POST['apellidomaterno'];
$empresa = $_POST['empresa'];
$asunto = $_POST['asunto'];
$ubicacion = $_POST['piso'];


    $consulta="UPDATE srcv_visitas
    SET NOMBRE='$nombre', APELLIDO_PATERNO='$apellidopa', APELLIDO_MATERNO='$apellidoma', EMPRESA='$empresa', ASUNTO='$asunto', PISO='$ubicacion', USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion' WHERE ID_VISITA='$id'";
    $sql=mysqli_query($conexion, $consulta);
  

    if ($sql) {
        // Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> El registro se ha guardado correctamente
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else {
        // Error: alerta de Bootstrap error con detalles
        $mensaje = '<div class="alert alert-danger" role="alert">Error al registrar cambios: ' . mysqli_error($conexion) . '</div>';
    }
    
    mysqli_close($conexion);
    
    header("location: ../Vista/vista_historial_visitas.php?mensaje=" . urlencode($mensaje));
    
    
    ?>