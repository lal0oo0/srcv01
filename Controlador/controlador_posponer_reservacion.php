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
$variable = $_POST['id'];
$variable1 = $_POST['Fechainicio'];
$variable2 = $_POST['Fechafinalizacion'];
$variable3 = $_POST['Horainicio'];
$variable4 = $_POST['Horafinalizacion'];
$variable5 = $_POST['Total'];
$variable6 = $_POST['enganche'];
$variable8 = $_POST['Abono'];
$variableSuma= $variable6+$variable8;
$variable7 = intval($variable5)-intval($variableSuma);


    $consulta="UPDATE srcv_reservaciones SET USUARIO_MODIFICACION='$usermodi', FECHA_MODIFICACION='$fechamodificacion', FECHA_ENTRADA='$variable1', FECHA_SALIDA='$variable2', HORA_ENTRADA='$variable3', HORA_SALIDA='$variable4', ENGANCHE='$variableSuma', LIQUIDACION='$variable7' WHERE ID_RESERVACION='$variable'";
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
    
    header("location: ../Vista/vista_reservaciones_urspace.php?mensaje=" . urlencode($mensaje));
    
    
    ?>