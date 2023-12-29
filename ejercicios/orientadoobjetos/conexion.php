<?php

    $servidor = "localhost";
    $usuario = "usuarioadmin";
    $contrasena = "usuarioadmin";
    $basededatos = "empresa";

    //CONEXION BBDD
    $conexion = new mysqli($servidor,$usuario,$contrasena,$basededatos);

    //CONTROL DE CONEXION 
    if($conexion->connect_error){
        die("Error en la conexión con la BBDD");
    }

    $peticion = "CREATE TABLE clientes ( 
                              identificador INT(255) NOT NULL AUTO_INCREMENT ,
                              nombre VARCHAR(255) NOT NULL , 
                              apellidos VARCHAR(255) NOT NULL , 
                              email VARCHAR(255) NOT NULL , PRIMARY KEY (identificador)) ENGINE = InnoDB;";
    
    $resultado = $conexion->query($peticion);

    $conexion->close();

?>