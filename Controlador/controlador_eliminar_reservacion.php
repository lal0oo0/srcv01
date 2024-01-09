<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

    $id=$_GET["id"];
    $sql = "UPDATE srcv_reservaciones SET ESTATUS='0' where ID_RESERVACION='$id'";
    $resultado=mysqli_query($conexion,$sql);

    if ($resultado) {
        echo '<div>Registro eliminado correctamente</div>';
    } else {
        echo '<div>Error al elimianr el registro</div>';
    }
?>