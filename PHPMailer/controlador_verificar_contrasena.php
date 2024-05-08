<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../Modelo/conexion2.php';
require_once 'vendor/autoload.php';

$conexion = conect();
$mensaje = '';
$correo_mostrado = true;
$nombre_usuario = '';

// Función para generar un código de verificación aleatorio
function generarCodigoVerificacion($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo_verificacion = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo_verificacion .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo_verificacion;
}

// Verificar si se envió un formulario con el correo electrónico o el código de verificación y la nueva contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["correo"])) {
        $correo = $_POST["correo"];

        // Validar el formato del correo electrónico
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            // Validar si el correo electrónico está registrado
            $sql = "SELECT CORREO_ELECTRONICO, NOMBRE FROM srcv_administradores WHERE CORREO_ELECTRONICO=? LIMIT 1";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si se encontró el correo electrónico en la base de datos
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $mensaje = '<div class="alert alert-success" role="alert">El correo electrónico está registrado.</div>';
                $_SESSION['correo_encontrado'] = true;
                $correo_mostrado = false;
                $_SESSION['correo'] = $correo; 
                $_SESSION['nombre_usuario'] = $row['NOMBRE'];

                // Generar y almacenar el código de verificación en la sesión
                $codigo_verificacion = generarCodigoVerificacion();
                $_SESSION['codigo_verificacion'] = $codigo_verificacion;

                // Almacenar el código de verificación en la base de datos
                $sql_insert = "UPDATE srcv_administradores SET CODIGO = ? WHERE CORREO_ELECTRONICO = ?";
                $stmt_insert = $conexion->prepare($sql_insert);
                $stmt_insert->bind_param("ss", $codigo_verificacion, $correo);
                $stmt_insert->execute();

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
                        <title>Actualización de Contraseña</title>
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
                }
            } else {
                $mensaje = '<div class="alert alert-danger" role="alert">El correo electrónico no está registrado.</div>';
                $_SESSION['correo_mostrado'] = true;
            }
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">El formato del correo electrónico no es válido.</div>';
        }
    }
    // Verificar si se envió el código de verificación desde el modal
    if (isset($_POST["codigo"])) {
        // Obtener el código ingresado en el modal
        $codigo_ingresado = $_POST["codigo"];

        // Verificar si el código ingresado coincide con el almacenado en la base de datos
        $sql_select = mysqli_query($conexion, "SELECT CORREO_ELECTRONICO, CODIGO FROM srcv_administradores WHERE CORREO_ELECTRONICO = $correo");
        $sqlres = mysqli_fetch_assoc($sql_select);
        $codigobd=$sqlres['CODIGO'];

        if ($codigobd=$codigo_ingresado) {
            // El código ingresado es correcto, puedes continuar con el proceso de actualización de contraseña
            // Por ejemplo, redirigir a la página donde el usuario puede ingresar una nueva contraseña
            header("Location: ../Vista/ejemplorc.php");
            exit();
        } else {
            // El código ingresado no es correcto, puedes mostrar un mensaje de error
            $mensaje = '<div class="alert alert-danger" role="alert">El código ingresado no es válido.</div>';
        }
    }
}
?>
