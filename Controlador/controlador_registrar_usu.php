<?php

//Codigo de conexion a la base de datos
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

//Para capturar los campos
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

$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];

// Expresión regular para validar el formato del correo electrónico
$correo_valido = '/^\b[A-Za-z0-9._%+-]+@dominiopermitido\.com\b$/';

// Verificar si el correo electrónico tiene el dominio permitido
if (!preg_match($correo_valido, $correo)) {
    echo json_encode(array('success' => false, 'error' => 'El correo electrónico no es válido.'));
    exit();
}

//Codigo para guardar un registro temporalmente en una variable php
$usuario = "INSERT INTO srcv_administradores(NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, CONTRASENA, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA,ROL, ESTATUS) 
VALUES ('$nombre', '$ap', '$am', '$correo','$contraEncrip','$pregunta','$respuesta', 'Administrador', '1')";

//Evitar que el registro se repita
$norepetir = mysqli_query($conexion, "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$correo'");
if(mysqli_num_rows($norepetir) > 0){
    echo json_encode(array('success' => false, 'error' => 'El usuario ya existe, intente nuevamente.'));
    exit();
}

//Para ejecutar la consulta
$ejecutar = mysqli_query($conexion, $usuario); 


if ($ejecutar) {
  echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}


//Para cerrar conexion
mysqli_close($conexion);

?>