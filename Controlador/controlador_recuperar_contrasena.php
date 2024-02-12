<?php
require_once '../Modelo/conexion2.php';
$conexion = conect();
$correo = '';
$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;
$pregunta = ''; 
$respuesta_correcta = ''; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $correo = $_POST["email"];

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    } else {
        $sql = "SELECT CORREO_ELECTRONICO, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $correo_encontrado = true;
            $row = $result->fetch_assoc();
            $mensaje = '<div class="alert alert-success" role="alert">El correo electrónico está registrado.</div>';
            $_SESSION['correo_encontrado'] = true;
            $correo_mostrado = false;
            $_SESSION['correo'] = $correo; 
            $_SESSION['pregunta'] = $row['PREGUNTA_SEGURIDAD'];
            $_SESSION['respuesta'] = $row['RESPUESTA_PREGUNTA'];
            $correo_mostrado = false;
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
            $_SESSION['correo_mostrado'] = true;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["respuesta"])) {
    if (
        isset($_SESSION['respuesta']) && 
        $_POST["respuesta"] === $_SESSION['respuesta'] &&
        isset($_SESSION['pregunta']) &&
        $_POST["pregunta"] === $_SESSION['pregunta']
    ) {
        // Procesar el formulario de cambio de contraseña
        if (isset($_POST['passwo1']) && isset($_POST['confirmPasswo'])) {
            $passwo1 = $_POST['passwo1'];
            $confirmPasswo = $_POST['confirmPasswo'];

            // Verificar que las contraseñas coincidan
            if ($passwo1 === $confirmPasswo) {
                // Actualizar la contraseña en la base de datos
                $hashed_password = password_hash($passwo1, PASSWORD_DEFAULT); // Se recomienda usar password_hash() para almacenar contraseñas de forma segura
                $update_sql = "UPDATE srcv_administradores SET CONTRASENA = ? WHERE CORREO_ELECTRONICO = ?";
                $update_stmt = $conexion->prepare($update_sql);
                $update_stmt->bind_param("ss", $hashed_password, $correo);
                $update_stmt->execute();

                $to_email = $correo;
                $subject = "Recuperación de contraseña";
                $message = "Tu contraseña ha sido restablecida con éxito.";
                $headers = "From : tuemail@example.com\r\n";
                $headers .= "Reply-To: tuemail@example.com\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                // Envío del correo electrónico
                if (mail($to_email, $subject, $message, $headers)) {
                    echo "Correo electrónico enviado con éxito a $to_email.";
                } else {
                 echo "Error al enviar el correo electrónico.";
                 }
                header("Location: ../Vista/vista_inicio_sesion.php");
                exit();
                // Mostrar un mensaje de éxito
                $mensaje = '<div class="alert alert-success" role="alert">La contraseña se ha actualizado correctamente.</div>';
            } else {
                $mensaje = '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden.</div>';
            }
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">La respuesta proporcionada es incorrecta o la pregunta no coincide con la registrada.</div>';
    }
}
?>