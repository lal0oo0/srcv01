<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$variable = $_POST['id'];
$variable1 = $_POST['Fechainicio'];
$variable2 = $_POST['Fechafinalizacion'];
$variable3 = $_POST['Horainicio'];
$variable4 = $_POST['Horafinalizacion'];
$variable5 = $_POST['Total'];
$variable6 = $_POST['Enganche'];
$variable7 = $variable5-$variable6;


    $consulta="UPDATE srcv_reservaciones SET FECHA_ENTRADA='$variable1', FECHA_SALIDA='$variable2', HORA_ENTRADA='$variable3', HORA_SALIDA='$variable4', ENGANCHE='$variable6', LIQUIDACION='$variable7' WHERE ID_RESERVACION='$variable'";
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
    
    header("location: ../Vista/vista_historial_reservaciones.php?mensaje=" . urlencode($mensaje));
    
    
    ?>