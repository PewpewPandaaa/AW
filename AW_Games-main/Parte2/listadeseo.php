<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Lista de deseo';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

  $us=Usuario::buscaUsuario($_SESSION["username"]);
  $gm=Usuariodeseo::getJuegoDeseo($us->getId());
  $tamaño = count($gm);


  if($tamaño>2){
    $contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_admin">
    <!--<div id="contenido">-->
    EOS;
    }else{
    $contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_admin_noScroll"> 
    EOS;
    }
    $contenidoPrincipal .= <<<EOS
    <div class = "games_basic">
              <span id = "games_info"> 
                  <div id = "title">Lista de juegos deseados</div>
              </span>
        </div>
    <div id="contenido-admin">
EOS;


if( $tamaño == 0){
    $contenidoPrincipal.=<<<EOS
        
            <div id="vacio">
            <p> ¡No tienes ningun juego que deseas comprar! ¡Añadelos! </p>
            </div>
        </div>
        
    EOS;
  }

if($tamaño < 0){
$contenidoPrincipal .= <<<EOS
    
        <div id = "Juego1_wrapper" class="games">
        <div class="foto_wrapper"> 
             <img class="game-img" src= "img/avatar.png" alt="juego">
        </div>
        <div class="title_game_wrapper">
           <p> No hubo compras de Juego </p>
        </div>
    </div>
</div>
    
EOS;
}
else{

    $s = 0;
    foreach ($gm as $gm_name){

        if($s>0){
            $contenidoPrincipal .=<<<EOS
            <hr>
        EOS;
        }

    $juego = Juego::buscarJuegoPorNombre($gm_name); 
    $juegoId = $juego->getIdJuego();
    $formD = new FormEraseJuegoDes($juegoId);
    $htmlFormBorrar = $formD->gestiona();
    

    $contenidoPrincipal .=<<<EOS
        <div id="contenido">
            <div id = "Juego_wrapper" class="games">

                <div class="foto_wrapper"> 
                    <img class="game-img" src= "img/juegos/{$juego->getRutaImagen()}" alt="juego">
                </div>

                <div class="title_game_wrapper">
                    <span id = "game_info"> 
                        <div id="game_container_time">
                            <span id = "game">{$juego->getNombre()}   ({$juego->getGenero()})</span>
                            <!--<span id = "fecha_compra">fecha compra</span>-->
                        </div>
                        <div>
                            <span id = "description_game">
                                <div>{$juego->getInfoBasica()} </div>
                            </span>
                        </div>
                        <div id="sabermas">
                             <a href = "infoJuego.php?idJuego=$juegoId"> Leer Más </a>
                        </div>    
                       
                    </span>

                    <div id="button_container">
                        <div id="btn-DesFav">
                            $htmlFormBorrar
                        </div>
                    </div>

                </div>

                
            </div>
        
       </div>
            

    EOS;
    $s ++;
    }

}
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>