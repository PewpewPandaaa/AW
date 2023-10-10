<?php

namespace es\ucm\fdi\aw;

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/Juego.php';


$idJuego = isset($_GET["idJuego"]) ? htmlspecialchars(trim(strip_tags($_GET["idJuego"]))) : 0;

$juego = Juego::buscarJuegoNombrePorId($idJuego);
$arrayComentario = Comentarios::comentariosJuegos($idJuego);
$formC = new FormComunidad($idJuego);
$htmlFormComent = $formC->gestiona();







$img = "img/juegos/";

$tituloPagina = 'Comunidad';
$contenidoPrincipal = <<<EOS
<div id="contenido_gestion_user">
<div class="titulo-comunidad-juego">
<div class="img-comunidad-container">

      <img class="img-comunidad" src="img/juegos/{$juego->getRutaImagen()}">

    </div>


<h2>Bienvenido a la comunidad de {$juego->getNombre()}</h2>

</div> 

<div class="container-coment">
            $htmlFormComent
    </div>

<div class="container-mainJuego">
<div class="container-comunidad-juego">
 
  
EOS;



foreach ($arrayComentario as $comentarios) {
    $Usuario = Usuario::buscaPorId($comentarios->getIdUsuario());

    $avatar = $Usuario->getimagen1();

    if ($Usuario->getimagen($comentarios->getIdUsuario()) == NULL)
        $avatar = 'img/avatar.png';
    else
        $avatar = "data:image/jpeg;base64, " . $Usuario->getimagen($comentarios->getIdUsuario());

    $cometarioUsuario = nl2br($comentarios->getComentario());


    $contenidoPrincipal .= <<<EOS
  
        
    

        <div class="comunidad-comentario">
            <div class="inicio-usuario">
                <div class="img-avatar-container">
                    <img class="comentario-avatar" src="{$avatar}" alt="avatar">
                </div>
                <h4>{$Usuario->getNombre()}</h4>
            </div>
            <p>{$cometarioUsuario}</p>



   
  
            
    EOS;

    if (isset($_SESSION["login"])) {

        $us = Usuario::buscaUsuario($_SESSION["username"]);

        if ($us->getId() == $comentarios->getIdUsuario()) {

            $formE = new FormEliminarComunidad($idJuego,$comentarios->getId());
            $htmlFormEliComent = $formE->gestiona();

            $contenidoPrincipal .= <<<EOS

            

            <div class="container-coment">
                $htmlFormEliComent
            </div>
            
            EOS;


        }
    }

    $contenidoPrincipal .="</div>";
    
}


$contenidoPrincipal .= <<<EOS


        
    </div> 

</div>
</div>

EOS;



require __DIR__ . '/includes/vistas/plantillas/plantillaUser.php';
?>

