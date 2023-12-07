<?php
require ("conexion.php")
$consulta="SELECT * FROM srcv_salas";
$resultado=mysqli_query($link,$consulta);
eco $resultado;

?>