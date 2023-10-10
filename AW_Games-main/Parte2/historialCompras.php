<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Mis Juegos';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

  $us=Usuario::buscaUsuario($_SESSION["username"]);
  $gm=UsuarioG::getJuegoPorUsuario($us->getId());
  $tamaño = count($gm);

    
    if($tamaño == 0){
    
        $contenidoPrincipal = <<<EOS
            <div id="contenido">
                <div class="juego_container">
                    <div id="empty">
                    <p> ¡Aún no compraste ningún juego! Compra ahora mismo! </p>
                    </div>
                </div>
            </div>
            
        EOS;
  
    }else{
        $contenidoPrincipal=<<<EOS
            <div id="contenido_gestion_user">
       
        EOS;
    
   }


    if($tamaño>=1){
        $contenidoPrincipal .= <<<EOS
    
                <div class = "games_basic">
                    <span id = "games_info"> 
                        <div id = "title">Mis juegos</div>
                    </span>
                </div>
    
        EOS;
        
        $s = 0;
    
        foreach ($gm as $gm_name){
        
            if($s>0){
                $contenidoPrincipal .=<<<EOS
                    <hr>
                EOS;
        }
    
        $juego = Juego::buscarJuegoPorNombre($gm_name); 
        $juegoId = $juego->getIdJuego();
        $precio=UsuarioG::getPrecio($juegoId, $us->getId());

        $contenidoPrincipal .=<<<EOS

                <div id = "Juego_wrapper" class="games">
                    <div class="foto_wrapper"> 
                        <img class="game-img" src= "img/juegos/{$juego->getRutaImagen()}" alt="juego">
                    </div>

                    <div class="title_game_wrapper">
                        <span id = "game_info"> 
                            <div id="game_container_time">
                                <span id = "game">{$juego->getNombre()}   ({$juego->getGenero()})</span>
                            </div>
                            
                            <div>
                                <span id = "description_game">
                                    <div>{$juego->getInfoBasica()} </div>
                                </span>
                            </div>
                            
                            <div id="btn-m">
                                <a href = "infoJuego.php?idJuego=$juegoId"> Leer Más </a>
                            </div>    
                            
                            <div id="price_wrapper">
                                <span id = "price">{$precio}€ </span>
                            </div>
                        </span>
                    </div>
                </div>
    

        EOS;
        $s++;
        }

        $contenidoPrincipal .=<<<EOS
            </div>
        EOS;    
}
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>