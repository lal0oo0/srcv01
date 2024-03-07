<?php
session_start();
$useralta= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

date_default_timezone_set('America/Mexico_City');

/*Para capturar los campos*/
$nombre = $_POST['Nombre'];
$apellidop = $_POST['Apellidopaterno'];
$apellidom = $_POST['Apellidomaterno'];
$correo = $_POST['Correo'];
$telefono = $_POST['Telefono'];
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
$espacio = $_POST['nombre'];
// Generar un identificador único basado en la fecha y hora actual
$id_unico = (new DateTime())->format('YmdHis');

/*Codigo para guardar un registro temporalmente en una variable php*/
$consulta = "INSERT INTO srcv_reservaciones (ID_RESERVACION, ID_SALA, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRE_ESPACIO, CORREO_ELECTRONICO, TELEFONO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL, ENGANCHE, LIQUIDACION, USO, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
VALUES ('$id_unico', '$idsala', '$nombre', '$apellidop', '$apellidom', '$espacio', '$correo', '$telefono', '$fechaini', '$fechafin', '$horaini', '$horafin', '$personas', '$servicios', '$total', '$enganche', '$liquidacion', '0', '1', '$useralta', '$useralta')";

//Esta consulta es una prueba para guardar tambien el registro en la tabla de visitas
$consulta2= "INSERT INTO srcv_visitas (ID_VISITA, HORA_ENTRADA, FECHA, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, EMPRESA, ASUNTO, USUARIO_ALTA, USUARIO_MODIFICACION, ESTATUS)
VALUES ('$id_unico', '$horaini','$fechaini','$nombre','$apellidop','$apellidom','UrSpace','Reservacion','$useralta','$useralta','1')";


/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta); 
$ejecutar2= mysqli_query($conexion, $consulta2);
if ($ejecutar) {
	echo json_encode(array('success' => true));
} else {
	echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}

/*Para cerrar conexion*/
mysqli_close($conexion);

?>