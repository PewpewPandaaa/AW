<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw as path;

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Mi carrito';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

  $us=Usuario::buscaUsuario($_SESSION["username"]);
  $gmID=UsuarioCesta::getJuegoPorUsuario($us->getId());
  $tamaño = count($gmID);

  $contenidoPrincipal = <<<EOS
  <div id="contenido">
      <div class = "games_basic">
            <span id = "games_info"> 
                <div id = "title">Mi carrito</div>
            </span>
      </div>
  EOS;

  $contenidoPrincipal = <<<EOS

    <div class="cesta_container2">
    
      <div id = "payment_type_wrapper" >
        <p> ¡Compra realizada! </p>
       
        <button class="btn_terminar"> <a href="tienda.php"> VOLVER A TIENDA</button>
        
      </div>
    
      
      </div>
      
    
  EOS;
  
}

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>