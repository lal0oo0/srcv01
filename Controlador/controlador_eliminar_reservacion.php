<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

if (!empty($_POST["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from srcv_reservaciones where ID_RESERVACION=$id ");


    if ($sql) {
        echo '<div>Registro eliminado correctamente</div>';
    } else {
        echo '<div>Error al elimianr el registro</div>';
    }
}
?>