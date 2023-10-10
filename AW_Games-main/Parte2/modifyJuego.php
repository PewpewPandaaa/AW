<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormModifJuego.php';

$tituloPagina = 'Modificar los juegos';
$idJuego = isset($_GET['idJuego']) ? htmlspecialchars(trim(strip_tags($_GET["idJuego"]))) : 0;

$form = new FormModifJuego($idJuego);
$htmlFormModifJuego = $form->gestiona();
$contenidoPrincipal = '';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

    $contenidoPrincipal = <<<EOS
    <div id="contenido_modif">

    $htmlFormModifJuego

    </div>
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>