<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        ABD Games - Tienda
    </title>
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <?php

    if (isset($busqueda)) {
        $variable1 = $busqueda;
        
    } else {
        $variable1 = ($_GET['nom']);
    }

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

        <center>
            <div style="display:inline-block;vertical-align:top;"> <img src="img/game.gif" width="250" height="280">
            </div>
            <div style="display:inline-block;">
                <br>
                <br>
                <br>
                <br>
                <br>
                <FONT SIZE=15 COLOR="#85C1E9">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Compra juegos en ABD Games
                </FONT>
                <FONT SIZE=6 COLOR="#FBFCFC">
                    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La mejor tienda de juegos online</p>
                </FONT>
            </div>
            <br>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    <th colspan="6">
                        <h1><FONT SIZE=10 COLOR='#DAA520'> Lista de juegos</FONT></h1>
                    </th>
                </tr>
                <tr>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Imagen</FONT></th>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Nombre</FONT></th>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Precio</FONT></th>
                    <th><FONT SIZE=10 COLOR='#DAA520'> Comprar</FONT></th>
                </tr>
                <?php
                include("conexion.php");
                $usuario = mysqli_query($db, "SELECT * FROM usuario WHERE id = '$variable1'");
                $fila = mysqli_fetch_assoc($usuario);
                $saldo=$fila['saldo'];
                echo "<FONT SIZE=7 COLOR='#DAA520'> El saldo del usuario $variable1 es: $saldo €</FONT>";
                $consulta = mysqli_query($db, "SELECT * FROM juegos");
                while ($mostrar = mysqli_fetch_array($consulta)) {

                ?>
                    <tr>
                        <td><?php echo "<img src='img/" . $mostrar['imagen'] . ".png' width='400' height='230'>" ?> </td>
                        <?php $nombre=strtoupper($mostrar['nombre']);
                        $precio=$mostrar['precio'];
                        ?>
                        <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'> $nombre</FONT>" ?> </td>
                        <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'> $precio&nbsp€</FONT>" ?> </td>
                        <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'><a href='comprar.php?nom=".$variable1."&nomJuego=".$nombre."&precio=".$precio."&imagen=".$mostrar['imagen']."'>Comprar</a></FONT>" ?> </td>
                    </tr>
                    

                <?php
                }
                ?>
            </table>




        </center>

    </body>

</html>