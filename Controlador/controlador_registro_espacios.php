<?php
session_start();
$useralta= $_SESSION['correo'];

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/*Para capturar los campos*/
$nombre = $_POST['Nombre'];


// Verificar si NOMBRE ya existe
$verificacion = mysqli_query($conexion, "SELECT * FROM srcv_salas WHERE NOMBRE = '$nombre' ");
    if (mysqli_num_rows($verificacion) > 0) {
        echo json_encode(array('success' => false, 'error' => 'El nombre del espacio que ingreso ya existe.'));
        exit();
    }

	/*Codigo para guardar un registro temporalmente en una variable php*/
	$consulta = "INSERT INTO srcv_salas(NOMBRE, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION)
	VALUES ('$nombre', '1', '$useralta', '$useralta')";

    

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