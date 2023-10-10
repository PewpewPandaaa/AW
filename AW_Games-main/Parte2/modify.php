<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormModifUser.php';


$tituloPagina = 'Modificar mis datos';

$form = new FormModifUser();
$htmlFormModifUser = $form->gestiona();
$contenidoPrincipal = '';


$contenidoPrincipal = <<<EOS
    <div id="contenido">
        $htmlFormModifUser
    </div>   
EOS;


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>