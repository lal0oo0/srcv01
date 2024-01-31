<?php
/* Incluir el código de conexión a la base de datos */
require_once '../Modelo/conexion2.php';

/* Obtener la conexión a la base de datos */
$conexion = conect();

// Inicializar la variable de mensaje
$mensaje = '';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico del formulario
    $correo = $_POST["email"];

    // Verificar si el correo electrónico tiene un formato válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no tiene un formato válido.</div>';
    } else {
        // Consulta SQL para verificar si el correo electrónico ya existe en la base de datos
        $sql = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // El correo electrónico está registrado
            $mensaje = '<div class="alert alert-success" role="alert">El correo electrónico está registrado.</div>';
        } else {
            // El correo electrónico no está registrado
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
        }
    }
}
?>
