<?php

function conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $database="srcv1";
    $conect = mysql_connect ($server,$user,$pass) or die ("error de conexion con bd".mysql_error());
    mysql_select_db ($database,$conect);

    return $conect;
}


?>