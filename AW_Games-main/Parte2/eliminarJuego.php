<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Eliminar producto';
$idJuego = isset($_GET['idJuego']) ? htmlspecialchars(trim(strip_tags($_GET["idJuego"]))) : 0;

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){
    $jErase=Juego::eliminarJuego($idJuego);

    if($jErase){ 
        $contenidoPrincipal = <<<EOS
        <div id="contenido">
            <div class = "games_basic">
                <span id = "games_info"> 
                    <div id = "title">¡Ya está está eliminado!</div>
                </span>
            </div>
            <div id="contenido-admin">
        EOS;

    }else{
        $contenidoPrincipal = <<<EOS
        <div id="contenido">
            <div class = "games_basic">
                <span id = "games_info"> 
                    <div id = "title">¡Error de borrado, el usuario compró este juego!</div>
                </span>
            </div>
            <div id="contenido-admin">
        EOS;

    }
    
}  

$contenidoPrincipal .=<<<EOS
        </div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>
