<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        ABD Games - Mi biblioteca
    </title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    $variable1 = ($_GET['nom']);
    ?>
    <header>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="tienda.php?nom=<?php echo $variable1 ?>">Tienda</a></li>
                    <li><a href="biblioteca.php?nom=<?php echo $variable1 ?>">Biblioteca</a></li>
                    <li><a href="cuentaUsuario.php?nom=<?php echo $variable1 ?>">Cuenta</a></li>
                    <li><a href="entradaPagina.html">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>

    </header>

    <body>

        <body style="background-color:#040405ee">
            <center>
                <div style="display:inline-block;vertical-align:top;"> <img src="img/game.gif" width="250" height="280"> </div>
                <div style="display:inline-block;">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <FONT SIZE=15 COLOR="#85C1E9"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mi biblioteca</FONT>
                    <FONT SIZE=6 COLOR="#FBFCFC">
                        <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos los juegos que tengo en mi cuenta</p>
                    </FONT>
                </div>
                <br> <br> <br>
                <table>
                <tr>
                    <th colspan="6">
                        <?php echo"<h1><FONT SIZE=10 COLOR='#DAA520'> Biblioteca de juegos de $variable1</FONT></h1>"?>
                    </th>
                </tr>
                <tr>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Imagen</FONT></th>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Nombre</FONT></th>
                </tr>
                <?php
                include("conexion.php");

                $usuario = mysqli_query($db, "SELECT * FROM usuarioJuego WHERE idUsuario = '$variable1'");
               
                while ($mostrar = mysqli_fetch_array($usuario)) {

                ?>
                    <tr>
                        <td><?php  
                         $nombre=strtoupper($mostrar['nomJuego']);
                         $consulta = mysqli_query($db, "SELECT * FROM juegos WHERE nombre = '$nombre'");
                         $fila = mysqli_fetch_assoc($consulta);
                         $imagen=$fila['imagen'];
                        
                        echo "<img src='img/" . $imagen . ".png' width='400' height='230'>" ?> </td>


                        <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'> $nombre</FONT>" ?> </td>
                        
                       
                    </tr>
                    

                <?php
                }
                ?>
            </table>

            </center>
        </body>

    </body>

</html>