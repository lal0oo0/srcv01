<?php
$link = new mysqli("localhost", "root", "", "srcv");
if($link->connect_errno) {
    echo "<b>Fallo al conectar a la BD: </b>" . $mysqli->connect_errno . "---" . $mysqli-> connect_error;
    exit();
}
?>