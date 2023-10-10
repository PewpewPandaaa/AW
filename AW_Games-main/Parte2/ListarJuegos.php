<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Lista de productos';

$contenidoPrincipal = '';

if(isset($_SESSION["login"]) && $_SESSION["esAdmin"]){

    $gm=Juego::getJuegos();
    $tamaño = count($gm);
 
 
    $contenidoPrincipal=<<<EOS
        <div id="contenido_gestion_admin">
    EOS;

    $contenidoPrincipal .= <<<EOS
            <div class = "games_basic">
                <span id = "games_info"> 
                    <div id = "title">Lista de Juegos</div>
                </span>
            </div>
    
            <div id="contenido-admin">
    EOS;

    $s=0;

    foreach ($gm as $gm_name){

        if($s>0){
            $contenidoPrincipal .=<<<EOS
            <hr>
        EOS;
        }
    
        $juegoId = $gm_name->getIdJuego();
        $contenidoPrincipal .=<<<EOS
    

                <div id = "Juego_wrapper" class="games">
                    <div class="foto_wrapper"> 
                        <img class="game-img" src= "img/juegos/{$gm_name->getRutaImagen()}" alt="juego">
                    </div>
                    
                    <div class="title_game_wrapper">
                        <span id = "game_info"> 
                            <div id="game_container_time">
                                <span id = "game">{$gm_name->getNombre()}   ({$gm_name->getGenero()})</span>
                            </div>
                        
                            <div>
                                <span id = "description_game">{$gm_name->getInfoBasica()}</span>
                            </div>
                      
                            <div id="btn-m">
                                <a href= "modifyJuego.php?idJuego=$juegoId"> Modificar </a> 
                                &nbsp
                                <a href= "eliminarJuego.php?idJuego=$juegoId"> Borrar </a>
                            </div>   
                        
                            <div id="price_wrapper">
                                <span id = "precio">{$gm_name->getPrecio()}€ </span>
                            </div>
                        </span>
                    </div>
                </div>

        EOS;
        $s++;       
    }
    $contenidoPrincipal .=<<<EOS
            </div>
        </div>
EOS;


}



require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>