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
            $_SESSION['pregunta'] = $row['PREGUNTA_SEGURIDAD'];
            $_SESSION['respuesta'] = $row['RESPUESTA_PREGUNTA'];
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
            $mail->Body = '<html><body><p>Hola ' . $_SESSION['nombre_usuario'] . ',</p><p>Aquí está tu código de verificación para actualizar la contraseña: <b>' . $codigo_verificacion . '</b></p></body></html>';
            if ($mail->send()) {
                $mensaje .= '<div class="alert alert-success" role="alert">Se ha enviado un correo electrónico con el código de verificación.</div>';
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

// Procesar la respuesta al formulario de seguridad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["respuesta"])) {
    if (
        isset($_SESSION['respuesta']) && 
        $_POST["respuesta"] === $_SESSION['respuesta'] &&
        isset($_SESSION['pregunta']) &&
        $_POST["pregunta"] === $_SESSION['pregunta']
    ) {
        // Verificar si se ingresó un código de verificación y coincide
        if (isset($_POST['codigo_verificacion']) && $_POST['codigo_verificacion'] === $_SESSION['codigo_verificacion']) {
            // Verificar si se ingresó una contraseña y coinciden
            if (isset($_POST['passwo1']) && isset($_POST['confirmPasswo']) && $_POST['passwo1'] === $_POST['confirmPasswo']) {
                $passwo1 = $_POST['passwo1'];

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

                $hashed_password = encrypt($passwo1, $clave);
                //Fin del metodo de encriptar
                
                // Actualizar la contraseña en la base de datos
                $update_sql = "UPDATE srcv_administradores SET CONTRASENA = ? WHERE CORREO_ELECTRONICO = ?";
                $update_stmt = $conexion->prepare($update_sql);
                $update_stmt->bind_param("ss", $hashed_password, $_SESSION['correo']);
                $update_stmt->execute();

                if ($update_stmt->affected_rows > 0) {
                    // Envío de correo electrónico de confirmación de actualización de contraseña

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
                    $mail->addAddress($_SESSION['correo']);
                    $mail->isHTML(true);
                    $mail->Subject = 'Actualización de Contraseña';
                    $nueva_contrasena = $_POST['passwo1'];

                    $body = '<html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Actualización de Contraseña</title>
                        </head>
                        <body>
                        <div style="width: 100%; max-width: 500px; margin: 0 auto; padding: 20px;">
                        <div style="padding: 20px; text-align: center; background: #007AB6;max-width: 100%;height: auto; align: center;">
                        <h1 style="color: white;">iT-Global</h1>
                        </div>
                                <p style="font-size: 16px; color: black;">Hola ' . $_SESSION['nombre_usuario'] . ',</p>
                                <p style="font-size: 16px; color: black;">Se ha actualizado correctamente la contraseña, la nueva contraseña es:</p>
                                <p style="font-size: 17px; text-align: center;"><b>' . $nueva_contrasena . '</b></p>
                                <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                                <p style="font-size: 16px; color: black;">Ingrese al boton para que inicie sesion</p>
                                <p><span style="font-size: 16px;">
                                <a class="btn btn-primary" href="http://'.$link.'/srcv01/Vista/vista_inicio_sesion.php" style="display: inline-block; padding: 10px 20px; background-color: #007AB6; color: #ffffff; text-decoration: none; border-radius: 4px;">
                                Inicie sesion</a></p>
                                <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                            </div>
                            </div>
                                  </body>
                                  </html>';
                    $mail->Body = $body;

                    if ($mail->send()) {
                        $_SESSION['recuperacion_exitosa'] = true;
                        $mensaje = '<div class="alert alert-success" role="alert">La contraseña se ha actualizado correctamente y se ha enviado un correo electrónico de confirmación.</div>';
                        
                        // Redirigir al usuario al inicio de sesión
                        header("Location: ../Vista/vista_inicio_sesion.php");
                        exit();
                    } else {
                        $mensaje = '<div class="alert alert-danger" role="alert">Error al enviar el correo electrónico de confirmación.</div>';
                    }
                } else {
                    $mensaje = '<div class="alert alert-danger" role="alert">No se puede ingresar la misma contraseña, ingrese otra nueva.</div>';
                }
            }
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El código de verificación proporcionado es incorrecto.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">La respuesta proporcionada es incorrecta o la pregunta no coincide con la registrada.</div>';
    }
}
?>