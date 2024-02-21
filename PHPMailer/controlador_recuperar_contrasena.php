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
$pregunta = ''; 
$respuesta_correcta = '';

session_start();

// Verificar si se envió un formulario con el correo electrónico
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["correo"])) {
    $correo = $_POST["correo"];

    // Validar el formato del correo electrónico
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT CORREO_ELECTRONICO, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
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
            $_SESSION['pregunta'] = $row['PREGUNTA_SEGURIDAD'];
            $_SESSION['respuesta'] = $row['RESPUESTA_PREGUNTA'];
            $correo_mostrado = false;
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
            $_SESSION['correo_mostrado'] = true;
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">El formato del correo electrónico no es válido.</div>';
    }
}

// Procesar la respuesta al formulario de seguridad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["respuesta"])) {
    if (
        isset($_SESSION['respuesta']) && 
        $_POST["respuesta"] === $_SESSION['respuesta'] &&
        isset($_SESSION['pregunta']) &&
        $_POST["pregunta"] === $_SESSION['pregunta']
    ) {
        // Verificar si se ingresó una contraseña y coinciden
        if (isset($_POST['passwo1']) && isset($_POST['confirmPasswo']) && $_POST['passwo1'] === $_POST['confirmPasswo']) {
            $passwo1 = $_POST['passwo1'];
            // Metodo para encriptar la contrasenia
            $clave = "55Eu47x";

            function encrypt($string, $key)
        {
            $result = '';
             for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
            }
            return base64_encode($result);
        }
            //Encriptacion de la contrasenia:
            $hashed_password = encrypt($passwo1, $clave);
            //Fin del metodo de encriptar
            
            // Actualizar la contraseña en la base de datos
            $update_sql = "UPDATE srcv_administradores SET CONTRASENA = ? WHERE CORREO_ELECTRONICO = ?";
            $update_stmt = $conexion->prepare($update_sql);
            $update_stmt->bind_param("ss", $hashed_password, $_SESSION['correo']);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                // Envío de correo electrónico

                // Crear una nueva instancia de PHPMailer
                $mail = new PHPMailer(true);

                // Configurar el servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'itglobal071@gmail.com'; 
                $mail->Password = 'sqtwacekbdmnqjyq'; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = 'UTF-8';
            
                // Establecer el remitente y el destinatario
                $mail->setFrom('itglobal071@gmail.com', 'iT-Global');
                $correo_destino = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
            
                // Verificar si se proporcionó un correo electrónico válido
                if (!empty($correo_destino) && filter_var($correo_destino, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($correo_destino);
                } else {
                    $mensaje = '<div class="alert alert-danger" role="alert">Hubo un problema al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.</div>';
                }
            
                // Establecer el asunto y el cuerpo del mensaje
                $mail->isHTML(true);
                $mail->Subject = 'Actualización de Contraseña';
                $body .= '<p>
                  <span style="font-size: 18px;">
                  <a class="btn btn-primary" href="http://'.$link.'/srcv01/Vista/ejemplovrc.php" style="display: inline-block; padding: 10px 20px; background-color: #007AB6; color: #ffffff; text-decoration: none; border-radius: 4px;">
                   Ingresa aquí
                  </a>
                </p>';
                $mail->Body = $body;
            
                // Enviar el correo electrónico
                if ($mail->send()) {
                    $mensaje = '<div class="alert alert-success" role="alert">La contraseña se ha actualizado correctamente y se ha enviado un correo electrónico de confirmación.</div>';
                    
                    // Redirigir al usuario al inicio de sesión
                    header("Location: ../Vista/vista_inicio_sesion.php");
                    exit();
                } else {
                    $mensaje = '<div class="alert alert-danger" role="alert">Error al enviar el correo electrónico.</div>';
                }
            } else {
                $mensaje = '<div class="alert alert-danger" role="alert">La contraseña no se pudo actualizar correctamente.</div>';
            }
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">La respuesta proporcionada es incorrecta o la pregunta no coincide con la registrada.</div>';
    }
}
?>