<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

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

// Recuperar el código de verificación almacenado en la base de datos para el correo electrónico de la sesión
$sql = "SELECT CODIGO FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correo'";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);
$codigo_bd = $fila['CODIGO'];

// Verificar si el código ingresado por el usuario coincide con el código de la base de datos
if ($codigo == $codigo_bd) {
    // Consulta para actualizar la contraseña en la base de datos
    $sql_update = "UPDATE srcv_administradores SET CONTRASENA = '$contraEncrip' WHERE CORREO_ELECTRONICO = '$correo'";
    $resultado_update = mysqli_query($conexion, $sql_update);

    if($resultado_update) {
        echo json_encode(array('success' => true));
    }
} else {
    echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}

mysqli_close($conexion);

?>