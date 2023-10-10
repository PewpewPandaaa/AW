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

  if($tamaño>2){
    $contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_user">
    EOS;
  }else{
    $contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_user_noScroll"> 
    EOS;
  }

  $contenidoPrincipal .= <<<EOS
  <div id="contenido">
      <div class = "games_basic">
            <span id = "games_info"> 
                <div id = "title">Mi carrito</div>
            </span>
      </div>
  EOS;

  if($tamaño <= 0){
  $contenidoPrincipal .= <<<EOS
   
      <div id="vacio">
        <p> ¡Tú carrito está vacío! </p>
      </div>
    

  EOS;
  }
  else{

    $precioTotal=0;

    foreach ($gmID as $gm_name){
      $juego = Juego::buscarJuegoPorNombre($gm_name); 
      $juegoId = $juego->getIdJuego();
      $formE = new FormEraseJuegoCesta($juegoId);
      $htmlFormBorrar = $formE->gestiona();
      
      if(Juego::buscarJuegoReb($juegoId)){
        $precio=Juego::buscarJuegoNombreReb1($juegoId);
      }else{
        $precio=$juego->getPrecio();
      }
      
      $precioTotal+= $precio;

      $contenidoPrincipal .=<<<EOS

      <div id="cesta_container">

        <div id = "pago_wrapper" class="games">
        
          <span id = "game_info"> 
              <div id="game_container_time">
                  <span id = "game">{$juego->getNombre()}   ({$juego->getGenero()})</span>
              </div>
          </span>

          <div class="title_game_wrapper">
            <span id = "game_carrito">
            
              <div class="pago_img"> 
              <img class="pago_img" src= "img/juegos/{$juego->getRutaImagen()}" alt="juego">
              </div>
              
              <div>
                <span id = "description_game">
                  <button class="btn-desplegar">Mostrar descripción</button>
                      <div id="descrip_container" style="display: none;">{$juego->getInfoBasica()} </div>
                </span>
              </div>

              <div id="price_wrapper">
                <span id = "precio">{$precio}€ </span>
              </div>
            
            </span>
            
            <div id="button_container">
              <div id="btn-carrito">
                  $htmlFormBorrar
              </div>
            </div>
          
          </div>

        </div>

      </div>
  EOS;
      }

      $contenidoPrincipal.= <<<EOS
        <hr>
        <div id="resumen_container">
          <br>
          <h2> Resumen de juegos y aplicaciones </h2>
          <br>
          <h3> Precio Total:   $precioTotal  € </h3>
        </div>
          
          <div id="button_container">
          <br>
          <br>
            <button class="btn_terminar"> <a href="pago.php">FINALIZAR COMPRA</a></button>
          </div>
      
      EOS;

    }
    $contenidoPrincipal.= <<<EOS
    <script src="js/carritoDesplegar.js"> </script>
    EOS;
    
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>