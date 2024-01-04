<?php
session_start();

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();
$logitudPass = 8;
$miPassword  = substr( md5(microtime()), 4, $logitudPass);
$clave       = $miPassword;


$correoelectronico = $_POST['correoelectronico'];
$con = $_POST["contrasena"];

    $clave = "55Eu47x";

    function des_encrypt($string, $key)
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

    $contraDesencrip = des_encrypt($con, $clave);


$consulta           = ("SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO ='".$correoelectronico."'");
$queryconsulta      = mysqli_query($con, $consulta);
$cantidadConsulta   = mysqli_num_rows($queryconsulta);
$dataConsulta       = mysqli_fetch_array($queryconsulta);

if($cantidadConsulta ==0){ 
    header("Location:index.php?errorEmail=1");
    exit();
}else{
$updateClave    = ("UPDATE srcv_administradores SET contrasena='$clave' WHERE CORREO_ELECTRONICO ='".$correoelectronico."' ");
$queryResult    = mysqli_query($con,$updateClave); 

$destinatario = $correoelectronico; 
$asunto       = "Recuperando Clave - WebDeveloper";
}

if ($ejecutar) {
    // Éxito: alerta de Bootstrap éxito
    $mensaje= '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El registro se ha guardado correctamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} else {
    // Error: alerta de Bootstrap error con detalles
    $mensaje= '<div class="alert alert-danger" role="alert">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
}

mysqli_close($conexion);

header("location: ../Vista/vista_recuperar_contrasena.php?mensaje=" . urlencode($mensaje));
?>