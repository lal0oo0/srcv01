<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../Modelo/conexion2.php';
    // Llamar a la librería PHPMailer
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';


/* Obtener la conexión a la base de datos */
$conexion = conect();

// Recuperar el correo electrónico almacenado en la sesión
if(isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    exit("Error: No existe un correo electrónico.");
}

// Función para generar un código de verificación aleatorio
function generarCodigoVerificacion($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo_verificacion = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo_verificacion .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo_verificacion;
}

// Generar y almacenar el código de verificación en la sesión
$codigo_verificacion = generarCodigoVerificacion();
$_SESSION['codigo_verificacion'] = $codigo_verificacion;

//Consulta para insertar el codigo en la base de datos
$consulta = "UPDATE srcv_administradores SET CODIGO = '$codigo_verificacion' WHERE CORREO_ELECTRONICO = '$correo'";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta);

// Consulta SQL para obtener el nombre asociado con el correo electrónico de la sesión
$sql = "SELECT NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo'";
// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);
$nombre_usuario = $fila['NOMBRE'];

// Inicializar PHPMailer
$mail = new PHPMailer;

try {
    $correoR = mysqli_query($conexion, "SELECT * FROM srcv_configuracion_correo WHERE ID_CORREO='1'");
    $correosR = mysqli_fetch_assoc($correoR);
    $host = $correosR['HOST'];
    $username = $correosR['USERNAME'];
    $passwordEncr = $correosR['PASS'];
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
    $port = $correosR['PORT'];
    $remitente = $correosR['EMAIL'];
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
    $mail->addAddress($correo);
    $mail->isHTML(true);
    $mail->Subject = 'Código de Verificación';
    $mail->Body = '<html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Código de verificación</title>
                    </head>
                    <body>
                    <div style="width: 100%; max-width: 500px; margin: 0 auto; padding: 20px;">
                    <div style="padding: 20px; text-align: center; background: #007AB6;max-width: 100%;height: auto; align: center;">
                    <h1 style="color: white;">iT-Global</h1>
                    </div>
                            <p style="font-size: 16px; color: black;">Hola ' . $nombre_usuario . '.</p>
                            <p style="font-size: 16px; color: black;">Tu código de verificación para actualizar la contraseña es:</p>
                            <p style="font-size: 17px; text-align: center;"><b>' . $codigo_verificacion .  '</b></p>
                            <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                            <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                        </div>
                        </div>
                    </body>
                    </html>';
    // Enviar el correo
    $mail->send();
        // Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> Su código se ha enviado correctamente a su correo electrónico .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       header("Location: ../Vista/vista_recuperar_contrasena_codigo.php?mensaje=" . urlencode($mensaje));
        exit();
} catch (Exception $e) {
    echo "Error al enviar el código a su correo electrónico: {$mail->ErrorInfo}";
}

mysqli_close($conexion);

?>