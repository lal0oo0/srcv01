<?php
session_start();
session_destroy();
header('Location:../Vista/vista_inicio_sesion.php');
?>