<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$useralta = $_SESSION['correo'];

/* Código de conexión a la base de datos */
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();

// Obtén la fecha y hora actual
date_default_timezone_set('America/Mexico_City');
$fechaAlta = date('Y-m-d H:i:s');

/* Para capturar los campos del formulario */
$nombre = $_POST['nombre'];
$encabezado = $_POST['encabezado'];
$asunto = $_POST['asunto'];
$cuerpo = $_POST['cuerpo'];
$foot = $_POST['foot'];

// Verificar si se ha enviado una imagen
if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $file = $_FILES['file'];

    // Directorio donde se guardarán las imágenes (en este caso, 'imagenes/')
    $uploadDir = '../imagenes/';

    // Mostrar información del archivo subido
    echo 'Información del archivo:';
    var_dump($file);

    // Generar un nombre único para la imagen
    $uniqueName = uniqid('img_') . '_' . time();
    $uploadFile = $uploadDir . $uniqueName . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

    // Subir la imagen al servidor
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        echo "La imagen se ha subido correctamente.";

        // Ruta de la imagen para insertar en la base de datos
        $rutaImagen = $uploadFile;

        // Consulta SQL para insertar los datos en la tabla
        $consulta = "INSERT INTO srcv_promociones(NOMBRE_PROMOCION, ASUNTO, ENCABEZADO, CUERPO, PIE_PAGINA, RUTA_IMAGEN, ESTATUS, CREATION_DATE, LAST_UPDATE_DATE, CREATED_BY, LAST_UPDATED_BY)
                     VALUES ('$nombre', '$asunto', '$encabezado', '$cuerpo', '$foot', '$rutaImagen', '1', '$fechaAlta', '$fechaAlta', '$useralta', '$useralta')";

        // Ejecutar la consulta
        $ejecutar = mysqli_query($conexion, $consulta);

        if ($ejecutar) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
        }
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'No se ha seleccionado ninguna imagen.'));
}


/* Cerrar conexión */
mysqli_close($conexion);
?>

