<?php
session_start();
$ROL=$_SESSION['rol'];
$CORREO=$_SESSION['correo'];

require ("../PhpSpreadsheet/vendor/autoload.php");
require_once("../Modelo/conexion2.php");
$conexion = conect();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;// Para color de fondo de celdas
use PhpOffice\PhpSpreadsheet\Style\Color;// Para color de  letras de celdas.
use PhpOffice\PhpSpreadsheet\Style\Alignment;// Para centrar el texto de las celdas
use PhpOffice\PhpSpreadsheet\Style\Border;//Para los bordes de las celdas

// Verificar si hay una sesión activa
if (empty($_SESSION["correo"])){
    header("location: vista_inicio_sesion.php");
    exit; // Detener la ejecución del script después de redirigir
  }

// Obtener las fechas enviadas por el formulario

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

//Consulta para verificar el rol
$rol = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$CORREO' AND ROL='Administrador' AND ESTATUS='1'";
$rol_admin = mysqli_query($conexion, $rol);

$rol2 = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$CORREO' AND ROL='Recepcion' AND ESTATUS='1'";
$rol_recepcion = mysqli_query($conexion, $rol2);

$rol3 = "SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO='$CORREO' AND ROL='UrSpace' AND ESTATUS='1'";
$rol_urspace = mysqli_query($conexion, $rol3);


if($rol_admin->num_rows==1){
$sql = "SELECT NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA, EMPRESA, ASUNTO, ENTRADA_SEGURIDAD, ENTRADA_RECEPCION, ENTRADA_URSPACE, SALIDA_URSPACE, SALIDA_RECEPCION, SALIDA_SEGURIDAD  
FROM srcv_visitas  
WHERE FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin' AND FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$resultado = mysqli_query($conexion, $sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Historial");

$hojaActiva->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('A1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('A1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('A')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('A1', 'NOMBRE');
$hojaActiva->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('A1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('B1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('B1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('B')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->getStyle('B1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('B1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario



$hojaActiva->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('C1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('C1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('C')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->getStyle('C1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('C1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('D1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('D1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('D')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('D1', 'FECHA');
$hojaActiva->getStyle('D1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('D1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('E1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('E1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('E')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('E1', 'EMPRESA');
$hojaActiva->getStyle('E1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('E1')->getAlignment()->setWrapText(true); // Ajustar el texto si es necesario


$hojaActiva->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('F1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('F1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('F')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('F1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('F1', 'ASUNTO');
$hojaActiva->getStyle('F1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('F1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('G1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('G1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('G')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('G1', 'ENTRADA SEGURIDAD');
$hojaActiva->getStyle('G1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('G1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('H1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('H1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('H')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('H1', 'ENTRADA RECEPCION');
$hojaActiva->getStyle('H1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('H1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('I1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('I1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('I')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('I1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('I1', 'ENTRADA URSPACE');
$hojaActiva->getStyle('I1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('I1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('J1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('J1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('J1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('J')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('J1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('J1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('J1', 'SALIDA URSPACE');
$hojaActiva->getStyle('J1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('J1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('K1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('K1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('K1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('K')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('K1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('K1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('K1', 'SALIDA RECEPCION');
$hojaActiva->getStyle('K1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('K1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('L1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('L1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('L1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('L')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('L1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('L1', 'SALIDA SEGURIDAD');
$hojaActiva->getStyle('L1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('L1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->getStyle('A'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('A'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE']);
    $hojaActiva->getStyle('A'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('B'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('B'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->getStyle('B'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('C'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('C'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->getStyle('C'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('D'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('D'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('D'.$fila, $rows['FECHA']);
    $hojaActiva->getStyle('D'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('E'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('E'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('E'.$fila, $rows['EMPRESA']);
    $hojaActiva->getStyle('E'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('F'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('F'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('F'.$fila, $rows['ASUNTO']);
    $hojaActiva->getStyle('F'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('G'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('G'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('G'.$fila, $rows['ENTRADA_SEGURIDAD']);
    $hojaActiva->getStyle('G'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('H'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('H'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('H'.$fila, $rows['ENTRADA_RECEPCION']);
    $hojaActiva->getStyle('H'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('I'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('I'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('I'.$fila, $rows['ENTRADA_URSPACE']);
    $hojaActiva->getStyle('I'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('J'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('J'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('J'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('J'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('J'.$fila, $rows['SALIDA_URSPACE']);
    $hojaActiva->getStyle('J'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('K'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('K'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('K'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('K'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('K'.$fila, $rows['SALIDA_RECEPCION']);
    $hojaActiva->getStyle('K'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('L'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('L'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('L'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('L'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('L'.$fila, $rows['SALIDA_SEGURIDAD']);
    $hojaActiva->getStyle('L'.$fila)->getAlignment()->setWrapText(true);


    $fila++;
}

}else if($rol_recepcion->num_rows==1){
$sql = "SELECT NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA, EMPRESA, ASUNTO, PISO, ENTRADA_SEGURIDAD, SALIDA_SEGURIDAD 
FROM srcv_visitas  
WHERE FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin' AND FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$resultado = mysqli_query($conexion, $sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Historial");

$hojaActiva->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('A1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('A1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('A')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('A1', 'NOMBRE');
$hojaActiva->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('A1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('B1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('B1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('B')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->getStyle('B1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('B1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario



$hojaActiva->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('C1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('C1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('C')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->getStyle('C1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('C1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('D1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('D1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('D')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('D1', 'FECHA');
$hojaActiva->getStyle('D1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('D1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('E1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('E1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('E')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('E1', 'EMPRESA');
$hojaActiva->getStyle('E1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('E1')->getAlignment()->setWrapText(true); // Ajustar el texto si es necesario


$hojaActiva->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('F1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('F1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('F')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('F1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('F1', 'ASUNTO');
$hojaActiva->getStyle('F1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('F1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('G1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('G1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('G')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('G1', 'PISO');
$hojaActiva->getStyle('G1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('G1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('H1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('H1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('H')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('H1', 'HORA ENTRADA');
$hojaActiva->getStyle('H1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('H1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('64BAFF'); // Color en la celda
$hojaActiva->getStyle('I1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('I1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('I')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('I1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('I1', 'HORA SALIDA');
$hojaActiva->getStyle('I1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('I1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->getStyle('A'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('A'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE']);
    $hojaActiva->getStyle('A'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('B'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('B'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->getStyle('B'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('C'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('C'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->getStyle('C'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('D'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('D'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('D'.$fila, $rows['FECHA']);
    $hojaActiva->getStyle('D'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('E'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('E'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('E'.$fila, $rows['EMPRESA']);
    $hojaActiva->getStyle('E'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('F'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('F'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('F'.$fila, $rows['ASUNTO']);
    $hojaActiva->getStyle('F'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('G'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('G'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('G'.$fila, $rows['PISO']);
    $hojaActiva->getStyle('G'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('H'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('H'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('H'.$fila, $rows['ENTRADA_SEGURIDAD']);
    $hojaActiva->getStyle('H'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('I'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('I'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('I'.$fila, $rows['SALIDA_SEGURIDAD']);
    $hojaActiva->getStyle('I'.$fila)->getAlignment()->setWrapText(true);

    $fila++;

}

}else if($rol_urspace->num_rows==1){
// Obtener el valor del buscador
$busqueda = $_POST['buscador'];

$sql = "SELECT NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA, ASUNTO, MOTIVO, ENTRADA_URSPACE, SALIDA_URSPACE 
FROM srcv_visitas
WHERE (NOMBRE LIKE '%$busqueda%' 
                OR APELLIDO_PATERNO LIKE '%$busqueda%' 
                OR APELLIDO_MATERNO LIKE '%$busqueda%' 
                OR FECHA LIKE '%$busqueda%' 
                OR ASUNTO LIKE '%$busqueda%' 
                OR MOTIVO LIKE '%$busqueda%' 
                OR ENTRADA_URSPACE LIKE '%$busqueda%' 
                OR SALIDA_URSPACE LIKE '%$busqueda%')";
$resultado = mysqli_query($conexion, $sql);
  
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Historial");

$hojaActiva->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('A1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('A1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('A')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('A1', 'NOMBRE');
$hojaActiva->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('A1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('B1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('B1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('B')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->getStyle('B1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('B1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario



$hojaActiva->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('C1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('C1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('C')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->getStyle('C1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('C1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('D1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('D1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('D')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('D1', 'FECHA');
$hojaActiva->getStyle('D1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('D1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('E1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('E1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('E')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('E1', 'ASUNTO');
$hojaActiva->getStyle('E1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('E1')->getAlignment()->setWrapText(true); // Ajustar el texto si es necesario


$hojaActiva->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('F1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('F1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('F')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('F1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('F1', 'MOTIVO');
$hojaActiva->getStyle('F1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('F1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('G1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('G1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('G')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('G1', 'HORA ENTRADA');
$hojaActiva->getStyle('G1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('G1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('CC0000'); // Color en la celda
$hojaActiva->getStyle('H1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('H1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('H')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('H1', 'HORA SALIDA');
$hojaActiva->getStyle('H1')->getFont()->getColor()->setRGB('FFFFFF'); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('H1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->getStyle('A'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('A'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE']);
    $hojaActiva->getStyle('A'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('B'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('B'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->getStyle('B'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('C'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('C'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->getStyle('C'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('D'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('D'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('D'.$fila, $rows['FECHA']);
    $hojaActiva->getStyle('D'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('E'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('E'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('E'.$fila, $rows['ASUNTO']);
    $hojaActiva->getStyle('E'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('F'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('F'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('F'.$fila, $rows['MOTIVO']);
    $hojaActiva->getStyle('F'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('G'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('G'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('G'.$fila, $rows['ENTRADA_URSPACE']);
    $hojaActiva->getStyle('G'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('H'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0F0F0'); // Color en la celda
    $hojaActiva->getStyle('H'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('H'.$fila, $rows['SALIDA_URSPACE']);
    $hojaActiva->getStyle('H'.$fila)->getAlignment()->setWrapText(true);

    $fila++;

}
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="visitas.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;