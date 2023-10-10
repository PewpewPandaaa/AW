<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormRecargo.php';

$tituloPagina = 'Recargar Saldo';

$form = new FormRecargo();
$htmlFormRecargo = $form->gestiona();
$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

  $us=Usuario::buscaUsuario($_SESSION["username"]);


  $contenidoPrincipal = <<<EOS
    <div id="contenido">
        <div id= "actual_balance_wrapper">
          <span id= "balance_title"> Saldo Actual: </span>
          <span> {$us->getsaldo()} €</span>
        </div>
        
        $htmlFormRecargo
    </div>   

EOS;

}

  require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>