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
    include("conexion.php");
    if (isset($busqueda)) {
        $variable1 = $busqueda;
    } else {
        $variable1 = ($_GET['nom']);
    }
    $imagen = $_GET['imagen'];
    $juego = strtoupper($_GET['nomJuego']);
    $precio = $_GET['precio'];

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
            <?php
            $usuario = mysqli_query($db, "SELECT * FROM usuario WHERE id = '$variable1'");
            $fila = mysqli_fetch_assoc($usuario);
            $saldo = $fila['saldo'];
            try {
                mysqli_query($db, "INSERT INTO usuariojuego (idUsuario, nomJuego) VALUES ('$variable1', '$juego')");
                if($saldo<$precio){
                    mysqli_query($db, "DELETE FROM usuariojuego WHERE usuariojuego.idUsuario = '$variable1' AND usuariojuego.nomJuego = '$juego'");
                    echo "<h1><FONT SIZE=10 COLOR='#DAA520'> No tienes el saldo suficiente para comprar el juego</FONT></h1>";
                }else{
                    
                    $saldo = $fila['saldo'] - $precio;
                    mysqli_query($db, "UPDATE usuario SET saldo = '$saldo' WHERE usuario.id = '$variable1'");
                    echo "<h1><FONT SIZE=10 COLOR='#DAA520'> Compras con éxito</FONT></h1>";
                }
               
            } catch (mysqli_sql_exception $e) {
                echo "<h1><FONT SIZE=10 COLOR='#DAA520'> Ya has comprado el juego</FONT></h1>";
            }

            ?>

            <table>
                <tr>
                    <td><?php echo "<img src='img/" . $imagen . ".png' width='400' height='230'>" ?> </td>
                    <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'> $juego</FONT>" ?> </td>
                    <td><?php echo "<FONT SIZE=7 COLOR='#DAA520'> $precio&nbsp€</FONT>" ?> </td>
                </tr>
            </table>
            <?php
            echo "<FONT SIZE=7 COLOR='#DAA520'> El saldo del usuario $variable1 es: $saldo €</FONT>";
            ?>

        </center>

    </body>

</html>