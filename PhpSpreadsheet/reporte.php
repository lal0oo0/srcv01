<?php

require ("../PhpSpreadsheet/vendor/autoload.php");
require_once("../Modelo/conexion2.php");
$conexion = conect();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$sql = "SELECT ID_RESERVACION, NOMBRE_CLIENTE, NOMBRE_ESPACIO, CORREO_ELECTRONICO, FECHA_ENTRADA, FECHA_SALIDA FROM srcv_reservaciones";
$resultado = mysqli_query($conexion, $sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Reservaciones");

$hojaActiva->setCellValue('A1', 'ID');
$hojaActiva->setCellValue('B1', 'NOMBRE');
$hojaActiva->setCellValue('C1', 'ESPACIO');
$hojaActiva->setCellValue('D1', 'CORREO ELECTRONICO');
$hojaActiva->setCellValue('E1', 'FECHA ENTRADA');
$hojaActiva->setCellValue('F1', 'FECHA SALIDA');

$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila, $rows['ID_RESERVACION']);
    $hojaActiva->setCellValue('B'.$fila, $rows['NOMBRE_CLIENTE']);
    $hojaActiva->setCellValue('C'.$fila, $rows['NOMBRE_ESPACIO']);
    $hojaActiva->setCellValue('D'.$fila, $rows['CORREO_ELECTRONICO']);
    $hojaActiva->setCellValue('E'.$fila, $rows['FECHA_ENTRADA']);
    $hojaActiva->setCellValue('F'.$fila, $rows['FECHA_SALIDA']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reservaciones.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
