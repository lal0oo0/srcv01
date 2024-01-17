<?php
session_start();
$useralta= $_SESSION['correo'];

/* Código de conexión a la base de datos */
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

/* De preferencia, siempre las variables van en minúscula */
$nombre = $_POST['Nombre'];
$Categoria = $_POST['Categoria'];

// Verificar si la combinación de CATEGORIA y NOMBRE ya existe
$verificacion = mysqli_query($conexion, "SELECT * FROM srcv_listas WHERE NOMBRE = '$nombre' AND CATEGORIA = '$Categoria'");
    if (mysqli_num_rows($verificacion) > 0) {
        echo json_encode(array('success' => false, 'error' => 'La combinación de CATEGORÍA y NOMBRE ya se encuentra registrada.'));
        exit();
    }

    if ($Categoria === "Empresa") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, USUARIO_ALTA, USUARIO_MODIFICACION) 
        VALUES ('$nombre', 'Empresa', '$useralta', '$useralta')";
    
    } elseif ($Categoria === "Asunto") {
        $consulta = "INSERT INTO srcv_listas(NOMBRE, CATEGORIA, USUARIO_ALTA, USUARIO_MODIFICACION) 
        VALUES ('$nombre', 'Asunto', '$useralta', '$useralta', '$useralta')";
    } else {
        echo "Categoría no válida";
        exit();
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
