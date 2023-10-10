<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw as path;

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Resumen del pedido';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){

    $us=Usuario::buscaUsuario($_SESSION["username"]);
    $gmID=UsuarioCesta::getJuegoPorUsuario($us->getId());
    $tamaño = count($gmID);

    if($tamaño> 2){
        $contenidoPrincipal.=<<<EOS
        <div id="contenido_gestion_user">
        EOS;
      }else{
        $contenidoPrincipal.=<<<EOS
        <div id="contenido_gestion_user_noScroll"> 
        EOS;
    }

    $contenidoPrincipal.= <<<EOS
    <div id="contenido">
        <div class = "games_basic">
            <span id = "games_info"> 
                <div id = "title">Resumen del pedido </div>
            </span>
        </div>
    EOS;

    $precioTotal=0;

    foreach ($gmID as $gm_name){
        $juego = Juego::buscarJuegoPorNombre($gm_name); 
        $juegoId = $juego->getIdJuego();
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

                <div class="foto_wrapper"> 
                    <img class="pago_img" src= "img/juegos/{$juego->getRutaImagen()}" alt="juego">
                </div>

                <div class="resumen_container">
                    <span id = "game_info"> 
                        <div id="price_wrapper">
                            <span id = "precio">{$precio}€ </span>
                        </div>
                        
                    </span>

                </div>

            </div>

        </div>

        EOS;
    }

    $contenidoPrincipal.= <<<EOS
        <div id="cesta_container">
            <hr>
            <div id="resumen_container">
                <h2> Total :   $precioTotal  € </h2>
                <br>
                <h3>Saldo disponible: {$us->getsaldo()} €</h3>
            </div>

        </div>

    EOS;

    if($us ->getsaldo()>=$precioTotal){
        $formE = new FormConfirmarPago($juegoId);
        $htmlFormPago = $formE->gestiona();

        $contenidoPrincipal.= <<<EOS
        <div id="button_container">
            $htmlFormPago
        </div>
        EOS;

    }else{
        $contenidoPrincipal.= <<<EOS
        <div id = "payment_wrapper" >
            <div id = "payment_wrapper"> ¡No te quedan saldo suficiente! </div>
        </div>


        <button class="btn_terminar"><a href="recarga.php"> RECARGAR SALDO</button>
        
        
        EOS;
        
    }
}

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>