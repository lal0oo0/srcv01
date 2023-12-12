<?php

    const BD_HOST = "localhost";
    const BD_NAME = "srcv";
    const BD_USER = "root";
    const BD_PASSWORD = "";
    const BD_CHARSET = "utf8";

    const BASE_URL = "http://localhost/srcv01";
    function conect(){
        $mysql = new mysqli(BD_HOST,BD_USER,BD_PASSWORD,BD_NAME);
        $mysql->set_charset(BD_CHARSET);
        if(mysqli_connect_errno()){
            echo "Error en la conexion: ".mysqli_connect_errno();
        }/*else{
            echo "Conexion exitosa";
        }*/
        return $mysql;
    }
?>