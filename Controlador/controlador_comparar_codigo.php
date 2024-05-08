<?php
require_once '../Modelo/conexion2.php';

$conexion = conect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["confirmPasswo"])) {
    // Obtener el código y la contraseña ingresados
    $codigo_ingresado = $_POST["codigo"];
    $confirmPasswo = $_POST["confirmPasswo"];

    // Consultar el código almacenado en la base de datos para el correo electrónico asociado
    $correo = $_SESSION['correo'];
    $sqlcorreo = "SELECT CODIGO FROM srcv_administradores WHERE CORREO_ELECTRONICO = ?";
    $stmtcorreo = $conexion->prepare($sqlcorreo);
    $stmtcorreo->bind_param("s", $correo);
    $stmtcorreo->execute();
    $resultcorreo = $stmtcorreo->get_result();
    $row = $resultcorreo->fetch_assoc();
    $codigobd = $row['CODIGO'];

    // Verificar si el código ingresado coincide con el almacenado en la base de datos
    if ($codigo_ingresado === $codigobd) {
        // Actualizar la contraseña en la base de datos
        $sql_update_contrasena = "UPDATE srcv_administradores SET CONTRASENA = ? WHERE CORREO_ELECTRONICO = ?";
        $stmt_update_contrasena = $conexion->prepare($sql_update_contrasena);
        $stmt_update_contrasena->bind_param("ss", password_hash($confirmPasswo, PASSWORD_DEFAULT), $correo);
        if ($stmt_update_contrasena->execute()) {
            // Mensaje de éxito
            $mensaje = '<script>alert("¡Contraseña actualizada con éxito! Ya puedes iniciar sesión con tu nueva contraseña."); window.location.href = "../Vista/inicio_sesion.php";</script>';
        } else {
            // Mensaje de error
            $mensaje = '<div class="alert alert-danger" role="alert">Error al actualizar la contraseña.</div>';
        }
    } else {
        // Mensaje de error si el código ingresado es incorrecto
        $mensaje = '<div class="alert alert-danger" role="alert">El código de verificación es incorrecto.</div>';
    }
}
?>