<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$nombre = $_POST['nombre'];
$ap = $_POST['ap'];
$am = $_POST['am'];
$correo = $_POST['email'];
$contrasenia = md5 ($_POST['pass']);
$rol = $_POST['rol'];
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];

/*Codigo para guardar un registro temporalmente en una variable php*/
$usuario = "INSERT INTO srcv_administradores(NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, CONTRASEÑA, ROL, PREGUNTA_SEGURIDAD, RESPUESTA_PREGUNTA) 
VALUES ('$nombre', '$ap', '$am', '$correo','$contrasenia','$rol','$pregunta','$respuesta')";

$norepetir = mysqli_query($conexion, "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$correo'");
if(mysqli_num_rows($norepetir) > 0){
  echo'
  <script>
     alert("Este correo ya está registrado, intenta con otro diferente");
     window.location = "../Vista/vista_registrar_usuario.php";
 </script>
';
exit(); 
}

/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $usuario); 


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

header("location: ../Vista/vista_registrar_usuario.php?mensaje=" . urlencode($mensaje));


?>