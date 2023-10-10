<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormLogin.php';

$tituloPagina = 'Login';

$contenidoPrincipal = '';

$form = new FormLogin();
$htmlFormLogin = $form->gestiona();
$contenidoPrincipal = '';

$contenidoPrincipal = <<<EOS
    <section>
        $htmlFormLogin
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </section>

    

EOS;

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>
