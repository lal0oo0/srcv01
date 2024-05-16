<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
require_once '../PHPMailer/vendor/autoload.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Recibir datos del formulario
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];

$contrasena = $_POST['confirmPasswo'];
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

// Recuperar la pregunta de seguridad almacenada y la contraseña en la base de datos para el correo electrónico de la sesión
$sql = "SELECT PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA, CONTRASENA FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo'";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);
$pregunta_bd = $fila['PREGUNTA_SEGURIDAD'];
$respuesta_bd = $fila['RESPUESTA_PREGUNTA'];
$passbd = $fila['CONTRASENA'];

// Verificar pregunta y respuesta de seguridad del usuario
if ($pregunta == $pregunta_bd && $respuesta == $respuesta_bd) {
    if($passbd==$contraEncrip){
        echo json_encode(array('success' => false, 'error' => 'La contraseña no puede ser igual a la anterior.'));
        exit();
    }
    // Consulta para actualizar la contraseña en la base de datos
    $sql_update = "UPDATE srcv_administradores SET CONTRASENA = '$contraEncrip' WHERE CORREO_ELECTRONICO = '$correo'";
    $resultado_update = mysqli_query($conexion, $sql_update);

    if($resultado_update) {
        //AQUI HAY QUE ENVIAR EL CORREO
        $user = "SELECT NOMBRE, CONTRASENA FROM srcv_administradores WHERE CORREO_ELECTRONICO='$correo'";
        $res = mysqli_query($conexion, $user);
        $fila = mysqli_fetch_assoc($res);
        $usuario = $fila['NOMBRE'];
        $con = $fila['CONTRASENA'];
            // Metodo para des-encriptar la contrasenia

        // Inicializar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuracion del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'itglobal071@gmail.com'; 
    $mail->Password = 'sqtwacekbdmnqjyq'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    // Configuracion del remitente y el destinatario
    $mail->setFrom('itglobal071@gmail.com', 'iT-Global');
    $mail->addAddress($correo);
    $mail->isHTML(true);
    $mail->Subject = 'Recuperacion de contraseña';
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
                            <p style="font-size: 16px; color: black;">Haz actualizado tu contraseña correctamente a:</p>
                            <p style="font-size: 17px; text-align: center;"><b>' . $contrasena .  '</b></p>
                            <p style="font-size: 16px; color: black;">Por favor, guarda esta información en un lugar seguro.</p>
                            <p style="font-size: 16px; color: black;">Atentamente,<br>iT-Global</p>
                        </div>
                        </div>
                    </body>
                    </html>';
    // Enviar el correo
    $mail->send();
        /* Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> Su contraseña se ha actualizado correctamente y ha sido enviada a su correo.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';*/
       echo json_encode(array('success' => true));
      // header("Location: ../Vista/vista_inicio_sesion.php?mensaje=" . urlencode($mensaje));
        exit();
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => 'Error al enviar el correo, intente nuevamente.'));
}
       // header("location: ../Vista/vista_inicio_sesion.php");
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Verifique los datos.'));
}

mysqli_close($conexion);

?>