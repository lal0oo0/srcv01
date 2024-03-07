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
$hojaActiva->getStyle('A1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('A1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('A')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('A1', 'NOMBRE');
$hojaActiva->getStyle('A1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('A1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('B1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('B1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('B')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->getStyle('B1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('B1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario



$hojaActiva->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('C1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('C1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('C')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->getStyle('C1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('C1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('D1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('D1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('D')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('D1', 'NOMBRE ESPACIO');
$hojaActiva->getStyle('D1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('D1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('E1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('E1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('E')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('E1', 'TELEFONO');
$hojaActiva->getStyle('E1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('E1')->getAlignment()->setWrapText(true); // Ajustar el texto si es necesario


$hojaActiva->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('F1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('F1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('F')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('F1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('F1', 'FECHA ENTRADA');
$hojaActiva->getStyle('F1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('F1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('G1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('G1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('G')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('G1', 'NUMERO PERSONAS');
$hojaActiva->getStyle('G1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('G1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('H1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('H1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('H')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('H1', 'SERVICIOS EXTRA');
$hojaActiva->getStyle('H1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('H1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario


$hojaActiva->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($colorC); // Color en la celda
$hojaActiva->getStyle('I1')->getFont()->setSize(12); // Tamaño de letra en la celda
$hojaActiva->getStyle('I1')->getFont()->setBold(true);// Establecer el texto en negrita
$hojaActiva->getColumnDimension('I')->setWidth(20);// Establecer el ancho de la columna a 20 unidades de ancho
$hojaActiva->getStyle('I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
$hojaActiva->getStyle('I1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
// Establecer la altura de una fila (por ejemplo, fila 1)
$hojaActiva->getRowDimension(1)->setRowHeight(40); // Altura de la fila 1 ajustada
$hojaActiva->setCellValue('I1', 'TOTAL');
$hojaActiva->getStyle('I1')->getFont()->getColor()->setRGB($colorL); // Obtener el estilo de la celda y establecer el color del texto en RGB
$hojaActiva->getStyle('I1')->getAlignment()->setWrapText(true);// Ajustar el texto si es necesario

/*
$hojaActiva->setCellValue('B1', 'APELLIDO PATERNO');
$hojaActiva->setCellValue('C1', 'APELLIDO MATERNO');
$hojaActiva->setCellValue('D1', 'NOMBRE ESPACIO');
$hojaActiva->setCellValue('E1', 'TELEFONO');
$hojaActiva->setCellValue('F1', 'FECHA ENTRADA');
$hojaActiva->setCellValue('G1', 'NUMERO PERSONAS');
$hojaActiva->setCellValue('H1', 'SERVICIOS EXTRA');
$hojaActiva->setCellValue('I1', 'TOTAL');*/

$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->getStyle('A'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('A'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE_CLIENTE']);
    $hojaActiva->getStyle('A'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('B'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('B'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('B'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->getStyle('B'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('C'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('C'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->getStyle('C'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('D'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('D'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('D'.$fila, $rows['NOMBRE_ESPACIO']);
    $hojaActiva->getStyle('D'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('E'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('E'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('E'.$fila, $rows['TELEFONO']);
    $hojaActiva->getStyle('E'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('F'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('F'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('F'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('F'.$fila, $rows['FECHA_ENTRADA']);
    $hojaActiva->getStyle('F'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('G'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('G'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('G'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('G'.$fila, $rows['NUMERO_PERSONAS']);
    $hojaActiva->getStyle('G'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('H'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('H'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('H'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('H'.$fila, $rows['SERVICIOS_EXTRA']);
    $hojaActiva->getStyle('H'.$fila)->getAlignment()->setWrapText(true);


    $hojaActiva->getStyle('I'. $fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('d9d9d9'); // Color en la celda
    $hojaActiva->getStyle('I'. $fila)->getFont()->setSize(11); // Tamaño de letra en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto horizontalmente en la celda
    $hojaActiva->getStyle('I'. $fila)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Centrar texto verticalmente en la celda
    $hojaActiva->setCellValue('I'.$fila, $rows['TOTAL']);
    $hojaActiva->getStyle('I'.$fila)->getAlignment()->setWrapText(true);


   /* $hojaActiva->setCellValue('A'.$fila, $rows['NOMBRE_CLIENTE']);
    $hojaActiva->setCellValue('B'.$fila, $rows['APELLIDO_PATERNO']);
    $hojaActiva->setCellValue('C'.$fila, $rows['APELLIDO_MATERNO']);
    $hojaActiva->setCellValue('D'.$fila, $rows['NOMBRE_ESPACIO']);
    $hojaActiva->setCellValue('E'.$fila, $rows['TELEFONO']);
    $hojaActiva->setCellValue('F'.$fila, $rows['FECHA_ENTRADA']);
    $hojaActiva->setCellValue('G'.$fila, $rows['NUMERO_PERSONAS']);
    $hojaActiva->setCellValue('H'.$fila, $rows['SERVICIOS_EXTRA']);
    $hojaActiva->setCellValue('I'.$fila, $rows['TOTAL']);*/

    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reservaciones.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
