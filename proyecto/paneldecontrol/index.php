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

    $peticion = "SHOW TABLES FROM empresa";

    $resultado = mysqli_query($conexion,$peticion);

    //RECOGEMOS CADA UNA DE LAS FILAS DEL ARRAY RESULTADO
    //while($fila = mysqli_fetch_assoc($resultado)){
    //    echo $fila["Tables_in_empresa"];
    //}

    //ENLACES PARA TABLAS
    while($fila = mysqli_fetch_assoc($resultado)){
        echo ("<a href='?tabla=" 
        . $fila["Tables_in_empresa"] 
        . "'><button>" 
        . $fila["Tables_in_empresa"] 
        ."</button></a>");
    }

    //MOSTRAR TABLA
    if (isset($_GET['tabla'])){
        echo "<h3>Mostrando el contenido de la tabla: ".$_GET['tabla'] ."</h3>";
        //MOSTRAR COLUMNAS
        $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
        $resultado = mysqli_query($conexion,$peticion);
        echo "<table border=1>";
        echo "<tr>";
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<th>" .$fila['Field']."</th>";
        }
        echo "<th>Acciones</th>";
        echo "</tr>";
        //LISTAR REGISTROS
        $peticion = "SELECT * FROM " . $_GET['tabla'] . ";";
        $resultado = mysqli_query($conexion,$peticion);

        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            foreach($fila as $registro){
                echo "<th>" .$registro."</th>";
            }
           echo"</tr>";
        }

        echo"</table>";
    }
    
    
?>