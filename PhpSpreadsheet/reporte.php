<?php

require ("../PhpSpreadsheet/vendor/autoload.php");
require_once("../Modelo/conexion2.php");
$conexion = conect();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;// Para color de fondo de celdas
use PhpOffice\PhpSpreadsheet\Style\Color;// Para color de  letras de celdas.
use PhpOffice\PhpSpreadsheet\Style\Alignment;// Para centrar el texto de las celdas
use PhpOffice\PhpSpreadsheet\Style\Border;//Para los bordes de las celdas

$colorC = "#0055B9";
$colorL = "#FFFFFF";


$sql = "SELECT NOMBRE_CLIENTE, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRE_ESPACIO, TELEFONO, FECHA_ENTRADA, NUMERO_PERSONAS, SERVICIOS_EXTRA, TOTAL FROM srcv_reservaciones";
$resultado = mysqli_query($conexion, $sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Reservaciones");

$hojaActiva->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('A1', 'NOMBRE')->getFont()->setSize(11); // Tamaño de letra 11 en la celda
$hojaActiva->getStyle('A1', 'NOMBRE')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('A1', 'NOMBRE')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(70); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('A1', 'NOMBRE');
$hojaActiva->getStyle('A1', 'NOMBRE')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('A1', 'NOMBRE')->getAlignment()->setWrapText(true);

$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->setCellValue('D1', 'NOMBRE ESPACIO');
$hojaActiva->setCellValue('E1', 'TELEFONO');
$hojaActiva->setCellValue('F1', 'FECHA ENTRADA');
$hojaActiva->setCellValue('G1', 'NUMERO PERSONAS');
$hojaActiva->setCellValue('H1', 'SERVICIOS EXTRA');
$hojaActiva->setCellValue('I1', 'TOTAL');

$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE_CLIENTE']);
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->setCellValue('D'.$fila, $rows['NOMBRE_ESPACIO']);
    $hojaActiva->setCellValue('E'.$fila, $rows['TELEFONO']);
    $hojaActiva->setCellValue('F'.$fila, $rows['FECHA_ENTRADA']);
    $hojaActiva->setCellValue('G'.$fila, $rows['NUMERO_PERSONAS']);
    $hojaActiva->setCellValue('H'.$fila, $rows['SERVICIOS_EXTRA']);
    $hojaActiva->setCellValue('I'.$fila, $rows['TOTAL']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reservaciones.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
