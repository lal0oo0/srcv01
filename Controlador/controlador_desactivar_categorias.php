<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

    $id=$_GET["id"];
    $sql = "UPDATE srcv_listas SET ESTATUS='0' where ID_LISTA ='$id'";
    $resultado=mysqli_query($conexion,$sql);

/*cambiar alertas*/
    if ($resultado) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> La categoría se ha desactivado correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje = '<div class="alert alert-danger" role="alert">Error al eliminar la categoría' . mysqli_error($conexion) . '</div>';
    }
mysqli_close($conexion);

header("location: ../Vista/vista_registro_categorias.php?mensaje=" . urlencode($mensaje));

?>