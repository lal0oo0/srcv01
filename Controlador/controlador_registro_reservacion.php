<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$nombre = $_POST['Nombre'];
$apellidop = $_POST['Apellidopaterno'];
$ = $_POST['Apellidomaterno'];
$variable4 = $_POST['Correo'];
$variable5 = $_POST['Fechainicio'];
$variable6 = $_POST['Fechafinalizacion'];
$variable7 = $_POST['Horainicio'];
$variable8 = $_POST['Horafinalizacion'];
$variable9 = $_POST['Total'];
$variable10 = $_POST['Enganche'];
$variable11 = $variable9-$variable10;

$idSala = $_POST['id_sala'];


/*Codigo para guardar un registro temporalmente en una variable php*/
$consulta = "INSERT INTO srcv_reservaciones (ID_SALA, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, TOTAL, ENGANCHE, LIQUIDACION) 
VALUES ('$idSala', '$variable1', '$variable2', '$variable3', '$variable4', '$variable5', '$variable6', '$variable7', '$variable8', '$variable9', '$variable10', '$variable11')";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta); 

/* Falta cambiar aquí las alertas */
if ($ejecutar) {
	echo json_encode(array('success' => true));
} else {
	echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}


/*Para cerrar conexion*/
mysqli_close($conexion);

?>