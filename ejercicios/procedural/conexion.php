<?php

    $servidor = "localhost";
    $usuario = "usuarioadmin";
    $contrasena = "usuarioadmin";
    $basededatos = "empresa";

    //CONEXION BBDD (sin creacion de objeto MSQLI)
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);

    //CONTROL BBDD
    if(!$conexion){
        die("Error en la conexion con BBDD");
    }

    $peticion = "CREATE TABLE productos ( 
        identificador INT(255) NOT NULL AUTO_INCREMENT ,
        nombre VARCHAR(255) NOT NULL , 
        precio DOUBLE(255,2) NOT NULL , 
        descripcion VARCHAR(255) NOT NULL ,
        PRIMARY KEY (identificador)) ENGINE = InnoDB;";

    $resultado = mysqli_query($conexion,$peticion);


?>