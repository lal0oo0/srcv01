<?php
session_start();
session_destroy();
// Devuelve una respuesta JSON indicando que el cierre de sesión fue exitoso
$response = array('success' => true);
echo json_encode($response);
?>