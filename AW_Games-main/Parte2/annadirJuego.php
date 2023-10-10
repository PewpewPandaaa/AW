<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormAnnadirJuego.php';


$tituloPagina = 'Añadir nuevos productos';

$form = new FormAnnadirJuego();
$htmlFormAnnadirJuego = $form->gestiona();
$contenidoPrincipal = '';

$contenidoPrincipal = '';

if(isset($_SESSION["esAdmin"])){

    $contenidoPrincipal = <<<EOS
        <div id="contenido">
            $htmlFormAnnadirJuego
        </div>   
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>