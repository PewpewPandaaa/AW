<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/style.css"/>
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/userStyle.css"/>
    <link rel="shortcut icon" href="<?= RUTA_IMGS ?>/wasd.png" />
    <script type="text/javascript" src="<?=RUTA_JS ?>/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?= RUTA_JS ?>/user.js"></script>
    <script type="text/javascript" src="<?= RUTA_JS ?>/carritoDesplegar.js"></script>
    <script src ="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="<?= RUTA_JS ?>/botonArriba.js"></script>

    <title><?= $tituloPagina ?></title>

</head>
<body onload="enviarMensaje()">
<?php
		require(RAIZ_APP.'/vistas/comun/navBar.php');
?>

<div id="contenedor">

    <main>
			<?= $contenidoPrincipal ?>
    </main>
    <div class="ir-arriba">&#129093; </div>


</div>

<?php
		require(RAIZ_APP.'/vistas/comun/footer.php');
?>

 

</body>
</html>