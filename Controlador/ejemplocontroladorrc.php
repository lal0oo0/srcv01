<?php
require_once '../Modelo/conexion2.php';

$conexion = conect();

session_start();

// Inicializar variables
$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];

    // Validar el formato del correo electrónico
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT CORREO_ELECTRONICO, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el correo electrónico en la base de datos
        if ($result->num_rows > 0) {
            $correo_encontrado = true;
            $row = $result->fetch_assoc();
            $mensaje = '<div class="alert alert-success" role="alert">El correo electrónico está registrado.</div>';
            $_SESSION['correo_encontrado'] = true;
            $_SESSION['correo'] = $correo; 
            $correo_mostrado = false;

            // Redirigir a la siguiente interfaz
            header("Location: ../Vista/vista_pregunta_respuesta.php");
            exit(); // Es importante salir del script después de redirigir
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
            $correo_mostrado = true;
        }
    }
    header("location: ../Vista/ejemplorc.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>
