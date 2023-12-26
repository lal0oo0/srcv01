<?php

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Recibir datos del formulario
$correoelectronico = $_POST['correoelectronico'];
$contrasena = $_POST['contrasena'];

// Verificar la existencia del usuario
$sql = $conexion->query (" SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correoelectronico' and CONTRASENA = '$contrasena'");

if ($datos=$sql->fetch_object()){
    
        // Redirigir al usuario a la página de inicio
        header("Location: ../Vista/vista_mapa_salas.php");
    } else {
        echo 'mal';
    }

$conexion->close();
?>