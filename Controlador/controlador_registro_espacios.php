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
$nombre = $_POST['Nombre'];
$ubicacion = $_POST['ubicacion'];

// Verificar si NOMBRE ya existe en esa UBICACIÓn
$verificacion = mysqli_query($conexion, "SELECT * FROM srcv_salas WHERE NOMBRE = '$nombre' AND UBICACION = '$ubicacion' ");
    if (mysqli_num_rows($verificacion) > 0) {
        echo json_encode(array('success' => false, 'error' => 'El nombre del espacio que ingresó ya existe en esa ubicación.'));
        exit();
    }

	/*Codigo para guardar un registro temporalmente en una variable php*/
	$consulta = "INSERT INTO srcv_salas(NOMBRE, UBICACION, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY)
	VALUES ('$nombre', '$ubicacion', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";

    

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