<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioRegistro.php';

$tituloPagina = "Registrar";

$form = new FormularioRegistro();
$htmlFormRegister = $form->gestiona();
$contenidoPrincipal = '';
$contenidoPrincipal = <<<EOS
   
    $htmlFormRegister
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

EOS;

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>