<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$usermodi = $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();


// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechamodificacion = date('Y-m-d H:i:s');
/*Para capturar los campos*/
$id = $_POST['idadmin'];
$username = $_POST['nombre'];
$host = $_POST['ap'];
$port = $_POST['am'];
$correo = $_POST['correo'];
$con = $_POST['pass'];
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
  $contraEncrip = encrypt($con, $clave);
  //Fin del metodo de encriptar


    $consulta="UPDATE srcv_configuracion_correo
    SET USERNAME='$username', HOST='$host', PORT='$port', EMAIL='$correo', PASS='$contraEncrip', LAST_UPDATED_BY='$usermodi', LAST_UPDATE_DATE='$fechamodificacion' WHERE ID_CORREO='$id'";
    $sql=mysqli_query($conexion, $consulta);
  

    if ($sql) {
        // Éxito: alerta de Bootstrap éxito
        $mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> La informacion de '.$nombre .' se ha modificado correctamente
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else {
        // Error: alerta de Bootstrap error con detalles
        $mensaje = '<div class="alert alert-danger" role="alert">Error al registrar cambios: ' . mysqli_error($conexion) . '</div>';
    }
    
    mysqli_close($conexion);
    
    header("location: ../Vista/vista_configuracion_correo.php?mensaje=" . urlencode($mensaje));
    
    
    ?>