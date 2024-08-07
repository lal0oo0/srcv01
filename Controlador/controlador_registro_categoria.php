<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$useralta= $_SESSION['correo'];

/* Código de conexión a la base de datos */
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechaAlta = date('Y-m-d H:i:s');

$nombre = $_POST['Nombre'];
$categoria = $_POST['Categoria'];

// Verificar si la combinación de CATEGORIA y NOMBRE ya existe
$correo = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE CATEGORIA = 'Correo' AND ESTATUS = '1'");
$nocorreo= mysqli_num_rows($correo);
$verificacion = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE NOMBRE = '$nombre' AND CATEGORIA = '$categoria'");
    if (mysqli_num_rows($verificacion) > 0) {
        echo json_encode(array('success' => false, 'error' => 'La combinación de CATEGORÍA y NOMBRE ya se encuentra registrada.'));
        exit();
    }

    if ($categoria === "Empresa") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY) 
        VALUES ('$nombre', 'Empresa', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";
    
    } elseif ($categoria === "Asunto") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY) 
        VALUES ('$nombre', 'Asunto', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";

    } elseif ($categoria === "Piso") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY) 
        VALUES ('$nombre', 'Piso', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";
    } elseif ($categoria === "Correo") {
        if($nocorreo < 1){
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY) 
        VALUES ('$nombre', 'Correo', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";
        }else{
            echo json_encode(array('success' => false, 'error' => 'Ya existe un correo activo, desactivelo para continuar,'));
            exit();
        }
    }

    $ejecutar = mysqli_query($conexion, $consulta);

    if ($ejecutar) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
    }

/* Para cerrar conexión */
mysqli_close($conexion);
?>
