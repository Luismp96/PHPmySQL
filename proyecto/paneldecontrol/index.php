<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Panel de Control</title>
        <meta charset="utf-8">
        <style>
            body,html{
                background: rgb(220,220,220);
                font-family: sans-serif;
            }
            header,main,footer{
                background: white;
                margin:auto;
                padding: 20px;
                width: 800px;
            }
            table{
                width: 100%;
            }
            table tr:first-child{
                background: black !important;
                color:white;
            }
            table tr:nth-child(odd){
                background: rgb(240,240,240);
            }
            header,footer{
                position:relative;
                z-index:1000;
                text-align: center;
            }
            main{
                box-shadow: 0px 0px 20px rgba(0,0,0,0.4);
            }
        </style>
    </head>
    <body>
        <header>Panel de Control</header>
        <main>
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

                //ATRAPO BORRADO
                if (isset($_GET['operacion'])){
                    if($_GET['operacion'] == "borrar"){
                        $cadena = 'DELETE FROM ' . $_GET['tabla'] . ' WHERE identificador="' . $_GET['id'] . '";';
                        $resultado = mysqli_query($conexion,$cadena);
                    }
                }

                //ATRAPO FORMULARIO
                if (isset($_POST['identificador'])){
                    echo "Insertamos nuevo registro";

                    $cadena = "INSERT INTO " . $_GET['tabla'] . " VALUES (NULL,";
                    foreach ($_POST as $clave => $campo){
                        if($clave != "identificador"){
                            $cadena .= '"' . $campo .'",';
                        }
                    }
                    $cadena = substr($cadena,0,-1);
                    $cadena .= ");";
                    echo $cadena;
                    $resultado = mysqli_query($conexion,$cadena);
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
                    echo "<table>";
                    echo "<tr>";
                    while($fila = mysqli_fetch_assoc($resultado)){
                    echo "<td>" .$fila['Field']."</td>";
                    }
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    //LISTAR REGISTROS
                    $peticion = "SELECT * FROM " . $_GET['tabla'] . ";";
                    $resultado = mysqli_query($conexion,$peticion);

                    while($fila = mysqli_fetch_assoc($resultado)){
                        echo "<tr>";
                        $contador = 0;
                        $id = 0;
                        foreach($fila as $registro){
                            echo "<td>" .$registro."</td>";
                            if($contador == 0){
                            $id = $registro;
                            }
                        $contador++;
                        }
                        echo "<td><a href='?tabla= ".$_GET['tabla']."&operacion=borrar&id=".$id ."'><button>Borrar</button></a></td>";
                        echo"</tr>";
                    }

                    //FORMULARIO DE INSERCION
                    $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
                    $resultado = mysqli_query($conexion,$peticion);
                    echo "<tr>";
                    echo "<form action='?tabla=".$_GET['tabla']."' method='POST'>";
                    while($fila = mysqli_fetch_assoc($resultado)){
                        echo "<td><input type='text' name='" .$fila['Field'] . "'></td>";
                    }
                    echo "<td><input type='submit'></td>";
                    echo "</form>";
                    echo "</tr>";
                    echo"</table>";
                }

            ?>
        </main>
        <footer>
            (c) 2023 Luis Martin Portillo
        </footer>
    </body>

</html>

