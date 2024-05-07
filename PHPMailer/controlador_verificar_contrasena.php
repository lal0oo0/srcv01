<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../Modelo/conexion2.php';
require 'vendor/autoload.php';

$link = $_SERVER['HTTP_HOST'];

$conexion = conect();
$correo = '';
$mensaje = '';
$correo_encontrado = false;
$correo_mostrado = true;
$nombre_usuario = '';

session_start();

// Función para generar un código de verificación aleatorio
function generarCodigoVerificacion($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo_verificacion = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo_verificacion .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo_verificacion;
}

// Verificar si se envió un formulario con el correo electrónico
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["correo"])) {
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
            $correo_mostrado = false;
            $_SESSION['correo'] = $correo; 
            $_SESSION['nombre_usuario'] = $row['NOMBRE'];
            $correo_mostrado = false;

            // Generar y almacenar el código de verificación en la sesión
            $codigo_verificacion = generarCodigoVerificacion();
            $_SESSION['codigo_verificacion'] = $codigo_verificacion;

            // Envío de correo electrónico con el código de verificación
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'itglobal071@gmail.com'; 
            $mail->Password = 'sqtwacekbdmnqjyq'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('itglobal071@gmail.com', 'iT-Global');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Código de Verificación';
            $mail->Body = '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Codigo de verificacion</title>
            </head>
            <body>
            <div style="width: 100%; max-width: 500px; margin: 0 auto; padding: 20px;">
            <div style="padding: 20px; text-align: center; background: #007AB6;max-width: 100%;height: auto; align: center;">
            <h1 style="color: white;">iT-Global</h1>
            </div>
                    <p style="font-size: 16px; color: black;">Hola ' . $_SESSION['nombre_usuario'] . ',</p>
                    <p style="font-size: 16px; color: black;">Aquí está tu código de verificación para actualizar la contraseña:</p>
                    <p style="font-size: 17px; text-align: center;"><b>' . $codigo_verificacion .  '</b></p>
                    <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                    <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                </div>
                </div>
                      </body>
                      </html>';
            if ($mail->send()) {
                $mensaje .= '<div class="alert alert-success" role="alert">Se ha enviado un correo electrónico con el código de verificación.</div>';
                // Almacenar el correo en la sesión para usarlo en el siguiente paso
                $_SESSION['correo_verificacion'] = $correo;
                // Redirigir a la página donde el usuario ingresará el código de verificación
                header("Location: ../Vista/vista_verificar_codigo.php");
                exit();
            } else {
                $mensaje .= '<div class="alert alert-danger" role="alert">Error al enviar el correo electrónico con el código de verificación.</div>';
            }
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
            $_SESSION['correo_mostrado'] = true;
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">El formato del correo electrónico no es válido.</div>';
    }
}
?>
