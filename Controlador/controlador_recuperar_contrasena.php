<?php
require_once '../Modelo/conexion2.php';
$conexion = conect();

$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $correo = $_POST["email"];

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        
    } else {
        // Consultar la base de datos para verificar si el correo electrónico está registrado
        $sql = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Comprobar si se encontró el correo electrónico en la base de datos
        if ($result->num_rows > 0) {
            $correo_encontrado = true;
            $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">El correo electrónico está registrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $_SESSION['correo_mostrado'] = false;
        } else {
            $correo_mostrado = false;
            $mensaje = '<div class="alert alert-danger alert-dismissible fade show" role="alert">El correo electrónico no está registrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $_SESSION['correo_encontrado'] = true;
        }
    }
}
?>

