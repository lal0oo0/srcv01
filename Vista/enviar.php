<?php
include ('../Modelo/conexion2.php');
$correo = trim($_REQUEST['email']);

$destinatario = "oruga270406@gmail.com";
$asunto = "Envio de correo de prueba";
$cuerpo = '
<html>
<head>
<title>Prueba de envio de correo</title>
</head>
<body>
<h1>Solicitud de contacto desde correo</h1>
<p>
contacto: ' . $asunto . ' <br>
</p>
</body>
</html>
';

$headers  = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=UTF8\r\n"; 

$headers .= "From: $email\r\n";
(mail($destinatario, $asunto, $cuerpo, $headers));

echo"Correo enviado";
?>
<a href="vista_recuperar_contrasena.php">Volver al inicio</a>