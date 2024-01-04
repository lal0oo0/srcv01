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
$variable5 = $_POST['Enganche'];


    $consulta="UPDATE srcv_reservaciones SET FECHA_ENTRADA='$variable1', FECHA_SALIDA='$variable2', HORA_ENTRADA='$variable3', HORA_SALIDA='$variable4', ENGANCHE='$variable5' WHERE ID_RESERVACION='$variable'";
    $sql=mysqli_query($conexion, $consulta);
  

    if ($consulta) {
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