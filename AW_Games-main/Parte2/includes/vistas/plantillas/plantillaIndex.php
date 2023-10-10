<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/style.css"/>
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/userStyle.css"/>
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/politica_infoLegal_style.css">
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/tienda.css">
    <link rel="stylesheet" id="estilo" type="text/css" href="<?= RUTA_CSS?>/contactar.css"/>
    <script src ="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="<?= RUTA_JS ?>/botonArriba.js"></script>

    <link rel="shortcut icon" href="<?= RUTA_IMGS ?>/wasd.png" />

    <title><?= $tituloPagina ?></title>

</head>
<body>
<div id="contenedor2">
    <?php
		require(RAIZ_APP.'/vistas/comun/navBar.php');
	?>
    
    <main>
        <article class="<?= $claseArticle?>">
			<?= $contenidoPrincipal ?>
        </article>
    </main>

    <div class="ir-arriba"> &#129093;</div>
    <?php
		require(RAIZ_APP.'/vistas/comun/footer.php');
	?>


</div>
</body>
</html>