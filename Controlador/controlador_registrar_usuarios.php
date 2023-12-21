<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$variable1 = $_POST['Nombre'];
$variable2 = $_POST['Apellidopaterno'];
$variable3 = $_POST['Apellidomaterno'];
$variable4 = $_POST['Correo'];
$variable5 = $_POST['Fechainicio'];
$variable6 = $_POST['Fechafinalizacion'];
$variable7 = $_POST['Horainicio'];
$variable8 = $_POST['Horafinalizacion'];
$variable9 = $_POST['Total'];
$variable10 = $_POST['Enganche'];
$variable11= $_POST['Liquidacion'];
//y$variable11= $_POST['salaSeleccionada'];
/*Codigo para guardar un registro temporalmente en una variable php*/
$consulta = "INSERT INTO srcv_reservaciones(NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO_ELECTRONICO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, TOTAL, ENGANCHE, LIQUIDACION) 
VALUES ('$variable1', '$variable2', '$variable3', '$variable4', '$variable5', '$variable6', '$variable7', '$variable8', '$variable9', '$variable10', '$variable11')";
/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta); 


if ($ejecutar) {
	echo 'éxito';
}
else{
	echo 'nel';
}


/*if ($ejecutar) {
	echo '
	<script>
	alert ("Resevacion exitosa");
	window.location="../Mapa_Salas.php";
	</script>';
}
else{
	echo '
	<script>
	alert ("Error en su reservacion");
	window.location="../Mapa_Salas.php";
	</script>';
}*/


/*Para cerrar conexion*/
mysqli_close($conexion);

?>