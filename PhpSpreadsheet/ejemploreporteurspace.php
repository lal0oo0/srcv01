<?php
session_start();
$ROL=$_SESSION['rol'];
$CORREO=$_SESSION['correo'];

require_once '../PhpSpreadsheet/vendor/autoload.php';
require_once '../Modelo/conexion2.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;// Para color de fondo de celdas
use PhpOffice\PhpSpreadsheet\Style\Color;// Para color de letras de celdas.
use PhpOffice\PhpSpreadsheet\Style\Alignment;// Para centrar el texto de las celdas
use PhpOffice\PhpSpreadsheet\Style\Border;// Para los bordes de las celdas

// Verificar si hay una sesión activa
if (empty($_SESSION["correo"])){
    header("location: vista_inicio_sesion.php");
    exit; // Detener la ejecución del script después de redirigir
}

$conexion = conect();

// Obtener las fechas enviadas por el formulario
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

//Consulta para verificar el rol
$rol_query = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$CORREO' AND ROL='UrSpace' AND ESTATUS='1'";
$rol_result = mysqli_query($conexion, $rol_query);

$rol_admin_query = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$CORREO' AND ROL='Administrador' AND ESTATUS='1'";
$rol_admin_result = mysqli_query($conexion, $rol_admin_query);

if ($rol_result->num_rows == 1) {
    $sql = "SELECT NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRE_ESPACIO, TELEFONO, FECHA_ENTRADA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL FROM srcv_reservaciones
            WHERE FECHA_ENTRADA BETWEEN '$fecha_inicio' AND '$fecha_fin' AND FECHA_SALIDA BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    $resultado = mysqli_query($conexion, $sql);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("Reservaciones");

    // Encabezados
    $sheet->setCellValue('A1', 'Nombre del cliente');
    $sheet->setCellValue('B1', 'Apellido paterno');
    $sheet->setCellValue('C1', 'Apellido materno');
    $sheet->setCellValue('D1', 'Espacio');
    $sheet->setCellValue('E1', 'Teléfono');
    $sheet->setCellValue('F1', 'Fecha de entrada');
    $sheet->setCellValue('G1', 'Número de personas');
    $sheet->setCellValue('H1', 'Servicios extra');
    $sheet->setCellValue('I1', 'Total');

    // Datos
    $row = 2; // Empezamos en la fila 2
    while ($row_data = mysqli_fetch_assoc($resultado)) {
        $sheet->setCellValue('A' . $row, $row_data['NOMBRE_CLIENTE']);
        $sheet->setCellValue('B' . $row, $row_data['APELLIDO_PATERNO']);
        $sheet->setCellValue('C' . $row, $row_data['APELLIDO_MATERNO']);
        $sheet->setCellValue('D' . $row, $row_data['NOMBRE_ESPACIO']);
        $sheet->setCellValue('E' . $row, $row_data['TELEFONO']);
        $sheet->setCellValue('F' . $row, $row_data['FECHA_ENTRADA']);
        $sheet->setCellValue('G' . $row, $row_data['NUMERO_PERSONAS']);
        $sheet->setCellValue('H' . $row, $row_data['SERVICIOS_EXTRA']);
        $sheet->setCellValue('I' . $row, $row_data['TOTAL']);
        $row++;
    }

    // Configuración del archivo
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reservaciones.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit();
} else {
    // Manejar el caso en el que el usuario no tenga el rol adecuado
    echo "No tiene permisos para acceder a este recurso.";
    exit();
}
?>