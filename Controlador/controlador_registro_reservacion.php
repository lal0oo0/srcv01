<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$nombre = $_POST['Nombre'];
$apellidop = $_POST['Apellidopaterno'];
$apellidom = $_POST['Apellidomaterno'];
$correo = $_POST['Correo'];
$fechaini = $_POST['Fechainicio'];
$fechafin = $_POST['Fechafinalizacion'];
$horaini = $_POST['Horainicio'];
$horafin = $_POST['Horafinalizacion'];
$personas = $_POST['Personas'];
$servicios = $_POST['Servicios'];
$total = $_POST['Total'];
$enganche = $_POST['Enganche'];
$liquidacion = $total-$enganche;

$idsala = $_POST['id_sala'];


/*Codigo para guardar un registro temporalmente en una variable php*/
$consulta = "INSERT INTO srcv_reservaciones (ID_SALA, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL, ENGANCHE, LIQUIDACION, USO) 
VALUES ('$idsala', '$nombre', '$apellidop', '$apellidom', '$correo', '$fechaini', '$fechafin', '$horaini, '$horafin', '$personas', '$servicios', '$total', '$enganche', '$liquidacion', '0')";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta); 

if ($ejecutar) {
	echo json_encode(array('success' => true));
} else {
	echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}


/*Para cerrar conexion*/
mysqli_close($conexion);

?>