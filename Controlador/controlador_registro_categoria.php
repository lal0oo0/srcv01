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


$nombre = $_POST['Nombre'];
$categoria = $_POST['Categoria'];

// Verificar si la combinación de CATEGORIA y NOMBRE ya existe
$verificacion = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE NOMBRE = '$nombre' AND CATEGORIA = '$categoria'");
    if (mysqli_num_rows($verificacion) > 0) {
        echo json_encode(array('success' => false, 'error' => 'La combinación de CATEGORÍA y NOMBRE ya se encuentra registrada.'));
        exit();
    }

    if ($categoria === "Empresa") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
        VALUES ('$nombre', 'Empresa', '1', '$useralta', '$useralta')";
    
    } elseif ($categoria === "Asunto") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
        VALUES ('$nombre', 'Asunto', '1', '$useralta', '$useralta')";

    } elseif ($categoria === "Piso") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
        VALUES ('$nombre', 'Piso', '1', '$useralta', '$useralta')";
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
