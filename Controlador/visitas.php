<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$he = $_POST['he'];
$fecha = $_POST['fecha'];
$nombre = $_POST['nombre'];
$apellidop = $_POST['ap'];
$apellidom = $_POST['am'];
$empresa = $_POST['empresa'];
$asunto = $_POST['asunto'];
$hs = $_POST['hs'];
//y$variable11= $_POST['salaSeleccionada'];
/*Codigo para guardar un registro temporalmente en una variable php*/
$visita = "INSERT INTO srcv_visitas(HORA_ENTRADA, FECHA, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, EMPRESA, ASUNTO, HORA_SALIDA) 
VALUES ('$he', '$fecha','$nombre','$apellidop','$apellidom','$empresa','$asunto','$hs')";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $visita); 


if ($ejecutar) {
	echo 'éxito';
}
else{
	echo 'nel';
}

mysqli_close($conexion);

?>