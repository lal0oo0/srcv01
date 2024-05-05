<?php
require_once '../Modelo/conexion2.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se encontró el correo en la base de datos (debes implementar esta lógica)
    $correo_encontrado = true; // Aquí debes implementar la lógica para verificar el correo en la base de datos

    if ($correo_encontrado) {
        // Si se encuentra el correo, redirigir a la siguiente interfaz
        header("Location: vista_pregunta_respuesta.php");
        exit(); // Es importante salir del script después de redirigir
    } else {
        // Si el correo no se encuentra, establecer un mensaje de error
        $mensaje = "El correo proporcionado no fue encontrado en nuestra base de datos.";
    }
}
?>