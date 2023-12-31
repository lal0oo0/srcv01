<?php
session_start();

/*Codigo de conexion a la base de datos*/
include '../Modelo/conexion2.php';
/* Obtener la conexión a la base de datos */
$conexion = conect();


// Recibir datos del formulario
$correoelectronico = $_POST['correoelectronico'];
$con = $_POST["contrasena"];

    // Metodo para des-encriptar la contrasenia
    $clave = "55Eu47x";

    function des_encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

    //Encriptacion de la contrasenia:
    $contraDesencrip = des_encrypt($con, $clave);
    //Fin del metodo de des-encriptar


// Consulta para verificar roles

//Rol UrSpace
$sql1 =  (" SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correoelectronico' and CONTRASENA = '$contraDesencrip' AND ROL='UrSpace' AND ESTATUS=1");
$urspace=$conexion->query($sql1);

//Rol IT-GLOBAL
$sql2 =  (" SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correoelectronico' and CONTRASENA = '$contraDesencrip' AND ROL='Recepcion' AND ESTATUS=1");
$recepcion=$conexion->query($sql2);

//Rol Seguridad
$sql3 =  (" SELECT * FROM srcv_administradores WHERE CORREO_ELECTRONICO = '$correoelectronico' and CONTRASENA = '$contraDesencrip' AND ROL='Seguridad' AND ESTATUS=1");
$seguridad=$conexion->query($sql3);


if($urspace->num_rows==1){ 
    $usuario=$urspace->fetch_assoc();

    $_SESSION["correo"] = $usuario["CORREO_ELECTRONICO"];
    $_SESSION["rol"] = "urspace";
    header("Location: ../Vista/vista_mapa_salas.php");
    exit();

}else if($recepcion->num_rows==1){
    $usuario=$recepcion->fetch_assoc();

    $_SESSION["correo"] = $usuario["CORREO_ELECTRONICO"];
    $_SESSION["rol"] = "recepcion";
    header("Location: ../Vista/vista_registro_visitas.php");
    exit();

} else if($seguridad->num_rows==1){
    $usuario=$seguridad->fetch_assoc();

    $_SESSION["correo"] = $usuario["CORREO_ELECTRONICO"];
    $_SESSION["rol"] = "seguridad";
    header("Location: ../Vista/vista_registro_visitas.php");
    exit();

} 

else {
    $error = 'yes';
    echo $error;
    exit();
}



$conexion->close();
?>