<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../Modelo/conexion2.php';
require_once '../PHPMailer/vendor/autoload.php';

/* Obtener la conexión a la base de datos */
$conexion = conect();

$link = $_SERVER['HTTP_HOST'];

// Recibir datos del formulario
$codigo = $_POST['codigo'];
$contrasena = $_POST['contrasena'];
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
  $contraEncrip = encrypt($contrasena, $clave);
  //Fin del metodo de encriptar

// Recuperar el correo electrónico almacenado en la sesión
if(isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    exit("Error: No existe un correo electrónico.");
}

$sql = "SELECT NOMBRE, CODIGO, CONTRASENA FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo'";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);
$codigo_bd = $fila['CODIGO'];
$usuario = $fila['NOMBRE'];
$contra_bd = $fila['CONTRASENA'];

// Verificar si el código ingresado por el usuario coincide con el código de la base de datos
if ($codigo == $codigo_bd) {

    // Validar que la nueva contraseña sea diferente a la actual
    if ($contraEncrip == $contra_bd) {
        echo json_encode(array('success' => false, 'error' => 'La nueva contraseña debe ser diferente a la actual.'));
        exit(); 
    }

    // Consulta para actualizar la contraseña en la base de datos
    $sql_update = "UPDATE srcv_administradores SET CONTRASENA = '$contraEncrip' WHERE CORREO_ELECTRONICO = '$correo'";
    $resultado_update = mysqli_query($conexion, $sql_update);

    if($resultado_update) {
        try {
            // Inicializar PHPMailer dentro del bloque try
            $mail = new PHPMailer(true);
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'itglobal071@gmail.com'; 
            $mail->Password = 'sqtwacekbdmnqjyq'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            // Configuración del remitente y el destinatario
            $mail->setFrom('itglobal071@gmail.com', 'iT-Global');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Actualización de contraseña.';
            $mail->Body = '<html lang="en">
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
                            <p style="font-size: 16px; color: black;">Hola ' . $usuario . ',</p>
                            <p style="font-size: 16px; color: black;">Se ha actualizado correctamente la contraseña, la nueva contraseña es:</p>
                            <p style="font-size: 17px; text-align: center;"><b>' . $contrasena . '</b></p>
                            <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                            <p style="font-size: 16px; color: black;">Ingrese al boton para que inicie sesion</p>
                            <p><span style="font-size: 16px;">
                            <a class="btn btn-primary" href="http://'.$link.'/srcv01/Vista/vista_inicio_sesion.php" style="display: inline-block; padding: 10px 20px; background-color: #007AB6; color: #ffffff; text-decoration: none; border-radius: 4px;">
                            Iniciar sesion</a></p>
                            <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                        </div>
                        </div>
                            </body>
                            </html>';
            // Enviar el correo
            $mail->send();
            echo json_encode(array('success' => true));
            exit(); 
        } catch (Exception $e) {
            echo json_encode(array('success' => false, 'error' => 'Error al ingresar su código ' . $mail->ErrorInfo));
            exit(); 
        }
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'El código ingresado no es correcto.'));
    exit(); 
}

mysqli_close($conexion);

?>