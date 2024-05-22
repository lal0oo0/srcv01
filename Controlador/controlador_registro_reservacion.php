<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$useralta = $_SESSION['correo'];

// Código de conexión a la base de datos
include '../Modelo/conexion2.php';
$conexion = conect();

date_default_timezone_set('America/Mexico_City');

// Capturar los campos del formulario
$check = isset($_POST['check']) ? $_POST['check'] : '0';
$idVisita = $_POST['id_visita'];
$nombre = $_POST['Nombre'];
$apellidop = $_POST['Apellidopaterno'];
$apellidom = $_POST['Apellidomaterno'];
$correo = $_POST['Correo'];
$telefono = $_POST['Telefono'];
$fechaini = $_POST['Fechainicio'];
$fechafin = $_POST['Fechafinalizacion'];
$horaini = $_POST['Horainicio'];
$horafin = $_POST['Horafinalizacion'];
$personas = $_POST['Personas'];
$servicios = $_POST['Servicios'];
$to = $_POST['Total'];
// Eliminar el símbolo de la moneda y otros caracteres no numéricos
$total = floatval(preg_replace('/[^0-9.]/', '', $to));

$eng = $_POST['Enganche'];
// Eliminar el símbolo de la moneda y otros caracteres no numéricos
$enganche = floatval(preg_replace('/[^0-9.]/', '', $eng));

$liquidacion = $total - $enganche;
$idsala = $_POST['id_sala'];
$espacio = $_POST['nombre'];
// Generar un identificador único basado en la fecha y hora actual
$id_unico = (new DateTime())->format('YmdHis');

// Inicializar las variables para ejecutar las consultas
$ejecutar = false;
$ejecutar2 = false;
$ejecutar3 = false;

if ($check == '1') {
    // Consulta para guardar solo en la tabla de reservaciones si ya existe una visita
    $consulta3 = "INSERT INTO srcv_reservaciones (ID_RESERVACION, ID_SALA, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRE_ESPACIO, CORREO_ELECTRONICO, TELEFONO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL, ENGANCHE, LIQUIDACION, USO, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
    VALUES ('$id_unico', '$idsala', '$nombre', '$apellidop', '$apellidom', '$espacio', '$correo', '$telefono', '$fechaini', '$fechafin', '$horaini', '$horafin', '$personas', '$servicios', '$total', '$enganche', '$liquidacion', '0', '1', '$useralta', '$useralta')";
    $ejecutar3 = mysqli_query($conexion, $consulta3);

    if ($ejecutar3) {
        // Consulta de actualización después de la consulta tres
        $actualizar_visita = "UPDATE srcv_visitas SET ID_RESERVACION = '$id_unico' WHERE ID_VISITA = '$idVisita'";
        $ejecutar_actualizacion = mysqli_query($conexion, $actualizar_visita);
    }

} else {
    // Consulta para guardar el registro en la tabla reservaciones
    $consulta1 = "INSERT INTO srcv_reservaciones (ID_RESERVACION, ID_SALA, NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRE_ESPACIO, CORREO_ELECTRONICO, TELEFONO, FECHA_ENTRADA, FECHA_SALIDA, HORA_ENTRADA, HORA_SALIDA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL, ENGANCHE, LIQUIDACION, USO, ESTATUS, USUARIO_ALTA, USUARIO_MODIFICACION) 
    VALUES ('$id_unico', '$idsala', '$nombre', '$apellidop', '$apellidom', '$espacio', '$correo', '$telefono', '$fechaini', '$fechafin', '$horaini', '$horafin', '$personas', '$servicios', '$total', '$enganche', '$liquidacion', '0', '1', '$useralta', '$useralta')";
    $ejecutar = mysqli_query($conexion, $consulta1);

    if ($ejecutar) {
        // Consulta para guardar también el registro en la tabla de visitas
        $consulta2 = "INSERT INTO srcv_visitas (ID_VISITA, HORA_ENTRADA, FECHA, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, EMPRESA, ASUNTO, USUARIO_ALTA, USUARIO_MODIFICACION, ESTATUS)
        VALUES ('$id_unico', '$horaini', '$fechaini', '$nombre', '$apellidop', '$apellidom', 'UrSpace', 'Reservacion', '$useralta', '$useralta', '1')";
        $ejecutar2 = mysqli_query($conexion, $consulta2);
    }
}

if (($ejecutar && $ejecutar2) || $ejecutar3) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}

// Cerrar conexión
mysqli_close($conexion);
?>
