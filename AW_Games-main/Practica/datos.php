<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        ABD Games - Recarga
    </title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    include("conexion.php");
    $variable1 = ($_POST['nom']);
    $saldoRecargado = $_POST['saldo'];
    $usuario = mysqli_query($db, "SELECT * FROM usuario WHERE id = '$variable1'");
    $fila = mysqli_fetch_assoc($usuario);
    $saldo = $fila['saldo'] + $saldoRecargado;
    mysqli_query($db, "UPDATE usuario SET saldo = '$saldo' WHERE usuario.id = '$variable1'");
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

    <center>
        <div style="display:inline-block;vertical-align:top;"> <img src="img/game.gif" width="250" height="280">
        </div>


        <div>
            <FONT SIZE=10 COLOR="#DAA520">Usuario <?php echo $variable1 ?></FONT>
        </div>
        <div>
            <FONT SIZE=10 COLOR="#DAA520">Recarga con éxito con valor de <?php echo $saldoRecargado ?> €</FONT>
        </div>
        <div>
        <FONT SIZE=10 COLOR="#DAA520">Saldo actual <?php echo $saldo ?> €</FONT>
        </div>

    </center>


</html>