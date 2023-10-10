<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormAceptarAmigo.php';


$tituloPagina = 'Notificacion de juegos';

$contenidoPrincipal = '';


if(isset($_SESSION["login"])){
  
  //$us=Usuario::getUsuarios();
  $us=Usuario::buscaUsuario($_SESSION["username"]);
  $gm=Usuariodeseo::getJuegoDeseo($us->getId());
  $tamaño = count($gm);

    // notificacion rebaja

    if($tamaño>2 ){
        $contenidoPrincipal=<<<EOS
        <div id="contenido_gestion_admin">
        <!--<div id="contenido">-->
        EOS;
        }else{
        $contenidoPrincipal=<<<EOS
        <div id="contenido_gestion_admin_noScroll"> 
        EOS;
    }



  if( $tamaño == 0){
    $contenidoPrincipal=<<<EOS
        <div class="juego_container">
            <div id="empty">
            <p> ¡No tienes ningun mensaje nuevo! </p>
            </div>
        </div>
        </div>
    EOS;
  }
  


    if($tamaño > 0){
        
        foreach ($gm as $gm_name){

            $juego = Juego::buscarJuegoPorNombre($gm_name); 
            $juegoId = $juego->getIdJuego();

            if (Juego::buscarJuegoReb($juegoId)){
                $reb= Juego::buscarJuegoNombreReb1($juegoId);
                $contenidoPrincipal .=<<< EOS

                <div id = "Juego_wrapper" class="games">

                <div class="foto_wrapper"> 
                    <img class="game-img" src= "img/juegos/{$juego->getRutaImagen()}" alt="juego">
                </div>

                <div class="title_game_wrapper">
                    <span id = "game_info"> 
                        <div id="game_container_time">
                            <span id = "game">{$juego->getNombre()} </span>
                           
                        </div>
                        <div>
                            <br>
                                <h3>Tu juego de deseo está de OFERTA : $reb € !!!</h3>
                            
                        </div>
                        <div id="sabermas">

                        <br>
                             <a href = "infoJuego.php?idJuego=$juegoId"> Leer Más </a>
                        </div>    
                       
                    </span>
                </div>

                </div>

                EOS;
            
            }
        }
    }
    
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>