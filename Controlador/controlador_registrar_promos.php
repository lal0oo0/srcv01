<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$useralta= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechaAlta = date('Y-m-d H:i:s');
/*Para capturar los campos*/
$nombre = $_POST['nombre'];
$encabezado = $_POST['encabezado'];
$asunto = $_POST['asunto'];
$cuerpo = $_POST['cuerpo'];
$foot = $_POST['foot'];

	/*Codigo para guardar un registro temporalmente en una variable php*/
	$consulta = "INSERT INTO srcv_promociones(NOMBRE_PROMOCION, ASUNTO, ENCABEZADO, CUERPO, PIE_PAGINA, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY)
	VALUES ('$nombre', '$asunto', '$encabezado', '$cuerpo', '$foot', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";

    

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