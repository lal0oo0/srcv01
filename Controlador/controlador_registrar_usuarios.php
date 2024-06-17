<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$useralta= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechaAlta = date('Y-m-d H:i:s');
/*Para capturar los campos*/
$nombre = $_POST['nombre'];
$ap = $_POST['ap'];
$am = $_POST['am'];
$correo = $_POST['email'];


$contrasenia = $_POST['pass'];
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
  $contraEncrip = encrypt($contrasenia, $clave);
  //Fin del metodo de encriptar

$rol = $_POST['rol'];
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];


/*Codigo para guardar un registro temporalmente en una variable php*/
$usuario = "INSERT INTO srcv_administradores(NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, CONTRASENA, ROL, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY, ESTATUS) 
VALUES ('$nombre', '$ap', '$am', '$correo','$contraEncrip','$rol','$pregunta','$respuesta','$fechaAlta','$fechaAlta','$useralta','$useralta','1')";

/*Evitar que el registro se repita*/ 
$norepetir = mysqli_query($conexion, "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$correo'");
if(mysqli_num_rows($norepetir) > 0){
  $mensaje= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> El usuario ya existe, intente nuevamente.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
header("location: ../Vista/vista_registro_administradores.php?mensaje=" . urlencode($mensaje));
exit(); 
}

/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $usuario); 


if ($ejecutar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje= '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El usuario se ha registrado correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje= '<div class="alert alert-danger" role="alert">Error al registrar al usuario.' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);

header("location: ../Vista/vista_registro_administradores.php?mensaje=" . urlencode($mensaje));


?>