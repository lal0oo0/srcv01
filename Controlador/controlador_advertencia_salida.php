<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../Modelo/conexion2.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';


$link = $_SERVER['HTTP_HOST'];

$id_visita = $_GET['id'];

/* Obtener la conexión a la base de datos */
$conexion = conect();

$cliente = mysqli_query($conexion, "SELECT * FROM srcv_visitas WHERE ID_VISITA = '$id_visita'");
$cliente_error = mysqli_fetch_assoc($cliente);
$user = mysqli_query($conexion, "SELECT NOMBRE, CORREO_ELECTRONICO FROM srcv_administradores WHERE ROL = 'Administrador'");
$admin = mysqli_fetch_assoc($user);
// Recuperar el correo electrónico almacenado en la sesión
if(isset($admin)) {
    $destin = $admin['CORREO_ELECTRONICO'];
    $name_destin = $admin['NOMBRE'];
    $visita = $cliente_error['NOMBRE'] . ' ' . $cliente_error['APELLIDO_PATERNO'] . ' ' . $cliente_error['APELLIDO_MATERNO'];
} else {
    exit("Error: No existe un correo electrónico.");
}

//Consulta para insertar el codigo en la base de datos
$consulta = "UPDATE srcv_visitas SET ERROR_SALIDA = '1' WHERE ID_VISITA = '$id_visita'";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta);

// Inicializar PHPMailer
$mail = new PHPMailer(true);

try {
    $correo = mysqli_query($conexion, "SELECT * FROM srcv_configuracion_correo WHERE ID_CORREO='1'");
    $correos = mysqli_fetch_assoc($correo);
    $host = $correos['HOST'];
    $username = $correos['USERNAME'];
    $passwordEncr = $correos['PASS'];
        // Metodo para desencriptar la contrasenia
        $clave = "55Eu47x";

        function des_encrypt($string, $key)
        {
            $string = base64_decode($string);
            $result = '';
            for ($i = 0; $i < strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) - ord($keychar));
                $result .= $char;
            }
            return $result;
        }

        // Desencriptar la contrasena:
        $password = des_encrypt($passwordEncr, $clave);
        //Fin del metodo de des-encriptar
    $port = $correos['PORT'];
    $remitente = $correos['EMAIL'];
    // Configuracion del servidor SMTP
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $remitente; 
    $mail->Password = $password; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = $port;
    $mail->CharSet = 'UTF-8';

    // Configuración del remitente y el destinatario
    $mail->setFrom($remitente, $username);
    $mail->addAddress($destin);
    $mail->isHTML(true);
    $mail->Subject = 'Error en confirmación de salida';
    $mail->Body = '<html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Error</title>
                    </head>
                    <body>
                    <div style="width: 100%; max-width: 500px; margin: 0 auto; padding: 20px;">
                    <div style="padding: 20px; text-align: center; background: #007AB6;max-width: 100%;height: auto; align: center;">
                    <h1 style="color: white;">iT-Global</h1>
                    </div>
                            <p style="font-size: 16px; color: black;">Hola ' . $name_destin . '.</p>
                            <p style="font-size: 16px; color: black;">El area de seguridad ha informado que hubo un error al confirmar la salida de ' . $visita . '.</p>
                            <p style="font-size: 16px; color: black;">Te sugerimos acceder al sistema para borrar la salida del registro dando click al siguiente enlace: <a href="http://'.$link.'/srcv01/Vista/vista_historial_visitas_administrador.php">Ir a historial de visitas</a>.</p>
                            <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                        </div>
                        </div>
                    </body>
                    </html>';
    // Enviar el correo
    $mail->send();
        // Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> Su advertencia se ha enviado correctamente a su administrador .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       header("Location: ../Vista/vista_registro_visitas.php?mensaje=" . urlencode($mensaje));
        exit();
} catch (Exception $e) {
    echo "Error al enviar la advertencia: {$mail->ErrorInfo}";
}

mysqli_close($conexion);

?>