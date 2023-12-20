<?php
/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$Nombre = $_POST['Nombre'];
$Categoria = $_POST['Categoria'];
//y$variable11= $_POST['salaSeleccionada'];
/*Codigo para guardar un registro temporalmente en una variable php*/
$consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA)
VALUES ('$Nombre', '$Categoria')";

/*Para ejecutar la consulta*/
$ejecutar = mysqli_query($conexion, $consulta); 


if ($ejecutar) {
	echo 'éxito';
}
else{
	echo mysqli_error($conexion);
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