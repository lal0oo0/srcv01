<?php
require ("conexion.php");
$consulta="SELECT * FROM srcv_salas";
$resultado=mysqli_query($link,$consulta);
while($arreglo=mysqli_fetch_assoc($resultado)){
    echo $arreglo["NOMBRE"];
    echo "<br/>";
};

?>