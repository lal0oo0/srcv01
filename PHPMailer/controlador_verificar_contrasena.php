<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../Modelo/conexion2.php';
require_once 'vendor/autoload.php';

$conexion = conect();

// Función para generar un código de verificación aleatorio
function generarCodigoVerificacion($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo_verificacion = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo_verificacion .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo_verificacion;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["correo"])) {
    $correo = $_POST["correo"];

    // Validar el formato del correo electrónico
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT CORREO_ELECTRONICO, NOMBRE, CODIGO FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el correo electrónico en la base de datos
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Generar y almacenar el código de verificación en la sesión
            $codigo_verificacion = generarCodigoVerificacion();
            $_SESSION['codigo_verificacion'] = $codigo_verificacion;

            // Guardar el código de verificación en la base de datos
            $sql_insert_codigo = "UPDATE srcv_administradores SET CODIGO = ? WHERE CORREO_ELECTRONICO = ?";
            $stmt_insert_codigo = $conexion->prepare($sql_insert_codigo);
            $stmt_insert_codigo->bind_param("ss", $codigo_verificacion, $correo);
            $stmt_insert_codigo->execute();

            // Envío de correo electrónico con el código de verificación
            $mail = new PHPMailer(true);
            // Configurar el objeto PHPMailer con tus credenciales y detalles de SMTP

            // Código HTML del correo electrónico
            $html_body = '<html lang="en">
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
                            <p style="font-size: 16px; color: black;">Hola ' . $row['NOMBRE'] . ',</p>
                            <p style="font-size: 16px; color: black;">Aquí está tu código de verificación para actualizar la contraseña:</p>
                            <p style="font-size: 17px; text-align: center;"><b>' . $codigo_verificacion .  '</b></p>
                            <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                            <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                        </div>
                        </div>
                            </body>
                            </html>';

            // Enviar correo electrónico
            try {
                // Configuración y envío del correo
                // ...

                // Mensaje de éxito
                $mensaje = '<div class="alert alert-success" role="alert">Se ha enviado un correo electrónico con el código de verificación.</div>';
            } catch (Exception $e) {
                // Mensaje de error
                $mensaje = '<div class="alert alert-danger" role="alert">Error al enviar el correo electrónico con el código de verificación.</div>';
            }
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">El formato del correo electrónico no es válido.</div>';
    }
}
?>