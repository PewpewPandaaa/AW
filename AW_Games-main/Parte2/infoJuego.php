<?php
namespace es\ucm\fdi\aw;
//use es\ucm\fdi\aw as path;

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/Juego.php';
require_once __DIR__ . '/includes/Comentarios.php';


$idJuego = isset($_GET["idJuego"]) ? htmlspecialchars(trim(strip_tags($_GET["idJuego"]))) : 0;

$juego = Juego::buscarJuegoNombrePorId($idJuego);

$formC = new FormComentarios($idJuego);
$htmlFormComent = $formC->gestiona();

$formE = new FormAnnadirCarro($idJuego);
$htmlFormCarro = $formE->gestiona();

$formF = new FormAddFav($idJuego);
$htmlFormFav = $formF->gestiona();

$formD = new FormAddDeseo ($idJuego);
$htmlFormDes = $formD->gestiona();

$formV = new FormValorGame ($idJuego);
$htmlFormVal = $formV->gestiona();

$formDC = new FormDeleteComent ($idJuego);
$htmlFormDC= $formDC->gestiona();


$tituloPagina = $juego->getNombre();
$contenidoPrincipal = "";

$contenidoPrincipal.=<<<EOS
<div id="contenido_gestion_user">
EOS;

$img = "img/juegos/";
$video = $juego->getRutaVideo();


$contenidoPrincipal .=  "<div class='container-titulo'><h2>{$juego->getNombre()}</h1>$htmlFormVal</div>";
$contenidoPrincipal .= "<div class='container-mainJuego'>";
$contenidoPrincipal .=  "<div class='container-img'><img src='$img{$juego->getRutaImagen()}'></div>";

    $contenidoPrincipal .= "<div class='container-juego-info'><div class='container-info'><h4>Precio</h4>";

        if(Juego::buscarJuegoReb($idJuego)){ 
            $contenidoPrincipal .= "<div id = tachar>";
            $prec = $juego->getPrecio();
            $contenidoPrincipal .=  "$prec €";
            $contenidoPrincipal .="</div>";
            $contenidoPrincipal .= "<h4> Oferta ! </h4>";
            $reba = Juego::buscarJuegoNombreReb1($idJuego);
            $contenidoPrincipal .=" $reba €";
            }

        else{
            $prec = $juego->getPrecio();
            $contenidoPrincipal .= "$prec €";

        }

    $contenidoPrincipal .= "</div>";
    $contenidoPrincipal .= "<div class='container-info'>
                                <h4>Descripción</h4>
                                <p>{$juego->getInfoBasica()}</p>
                            </div>

                            <div class='container-info'>
                                <h4>Fecha de lanzamiento</h4>
                                <p>{$juego->getfechaLanz()}</p>
                            </div>

                            <div class='container-info'>
                                <h4>Desarrollador</h4>
                                <p>{$juego->getdesarrollador()}</p>
                            </div>";

    if(isset($_SESSION["login"]) && !$_SESSION['esAdmin']){
        $us=Usuario::buscaUsuario($_SESSION["username"]);
        $contenidoPrincipal .= "<br>";
        
        /*Deseo */
        if(Juego:: inmygamelist($us->getId(),$idJuego)){
            $contenidoPrincipal .=<<<EOS
            <div class='button_container'>
                <div id="btn-info">
                <div> ¡Juego comprado! </div>
                </div>
            </div>
            EOS;

        }else if(Juego:: buscarJuegoDes($us->getId(),$idJuego)){
            $contenidoPrincipal .=<<<EOS
            <br>
            <div class='button_container'>
                <div id="btn-info">
                    <button type="submit" name="anniadir"><a href="listadeseo.php"> Visualizar en lista de deseos </a></button>           
                </div>
            </div>
            EOS;

        }else{
            $contenidoPrincipal .=<<<EOS
            <br>
            <div class='button_container'>
                <div id="btn-info">
                $htmlFormDes
                </div>
            </div>
            EOS;
        }
        
        /* Carrito */
        if(UsuarioCesta::buscarEnCesta($us->getId(), $idJuego)){
            $contenidoPrincipal .=<<<EOS
            <div class='button_container'>
                <div id="btn-info">
                    <button id="addToCartBtn"> <a href="carrito.php"> visualizar en carrito </a></button>
                </div>
            </div>
            EOS;

        }else if(UsuarioG::buscarEnUsuarioJuego($us->getId(), $idJuego)){
            $contenidoPrincipal .=<<<EOS
            <div class='button_container'>
                <div id="btn-info">
                    <button id="addToCartBtn"> <a href="historialCompras.php"> visualizar en mis juegos </a></button>
                </div>
            </div>
            EOS;
        }else{
            $contenidoPrincipal .=<<<EOS
            <div class='button_container'>
                <div id="btn-info">
                    $htmlFormCarro
                </div>
            </div>
            EOS;

        }

        /*Favorito */
        if(Juego:: buscarJuegoFav($us->getId(),$idJuego)){
            $contenidoPrincipal .=<<<EOS
            </div>
            <a href="listafavoritos.php" class = "buttonPressed"> <span class="buttonPressed"> </a>
            </div>
            EOS;

        }else if ( Juego:: inmygamelist($us->getId(),$idJuego)){

            $contenidoPrincipal .= "
            </div>
                $htmlFormFav
            </div>
            ";

        }else{
            $contenidoPrincipal .= "
            </div>
            <div>  </div>
        
            </div>
            ";

        }

    }
    else $contenidoPrincipal .= "</div> </div>";
if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']){
    
    $contenidoPrincipal .= <<<EOS
        <div id="btn-right-admin">
            <a href ="modifyJuego.php?idJuego=$idJuego" class ="Admin_game_modify"> Modificar</a>
            <a href ="eliminarJuego.php?idJuego=$idJuego" class ="Admin_game_erase"> Borrar</a>
        </div>
    EOS;
}

$contenidoPrincipal.=<<<EOS
    <div id="video-container" style = "position">
        <iframe width="560" height="315" src="$video" title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
    </div> 

    <div>
        <div class="comentBox">
            $htmlFormComent
        </div>
    
EOS;



        $sql_categorias = Comentarios::getAllCommentOfThisGame($idJuego);
        foreach ($sql_categorias as $comment) {
            $id = $comment['id'];
            $idUsuario = $comment['idUsuario'];
            
            $contentComent = $comment['contentComent'];
            $usuario = Usuario::buscaPorId($idUsuario);
            $avatar = $usuario->getimagen1(); //¿getimagen($idUsuario)?
            $userName = $usuario->getNombre();

            if($usuario->getimagen($idUsuario)==NULL)
                $avatar = 'img/avatar.png';
            else 
                $avatar = "data:image/jpeg;base64, ".$usuario->getimagen($idUsuario);

            $contenidoPrincipal.=<<<EOS
                <div class="juego-comentario">
                   
                    <div class="img-avatar-container">
                        <img class="juego-comentario-avatar" src="{$avatar}" alt="avatar">
                    </div> 
                    
                    <h4> {$userName} </h4> 
                    <button class="botonReportar" ><a href= "reportComment.php?idComentario=$id"> Reportar </a> </button>
                    </br>
                    <span> {$contentComent} </span>
            EOS;
            if(isset($_SESSION['login'])){
                $users = Usuario::buscaUsuario($_SESSION["username"]);
                if($users->getId() == $idUsuario  || (isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'])){
                    $contenidoPrincipal.=<<<EOS
                        $htmlFormDC
                        </div>
                    EOS;
                }
                else {
                    $contenidoPrincipal.=<<<EOS
                        </div>
                    EOS;
                }
            }
            else {
                $contenidoPrincipal.=<<<EOS
                    </div>
                EOS;
            }


        }

//juegos Relacionados
        $juegoRelacionado=Juego::getJuegoRelacionado($juego->getgenero(),$idJuego);
        $contenidoPrincipal.="<div id='juegoRelacionado'>";
                if (count($juegoRelacionado) > 0) {
                    $contenidoPrincipal.="<h4><br>Juegos Relacionados<br></h4>";
                    foreach($juegoRelacionado as $row) {
                        $img="img/juegos/";
                        $id=$row->getIdJuego();
                        $nombre=$row->getNombre();
                        $precio=$row->getPrecio();
                        $contenidoPrincipal .="<div class='imagen'>";
                        $contenidoPrincipal .="<a href='infoJuego.php?idJuego=$id'><img src='$img{$row->getRutaImagen()}'></a>";
                        $contenidoPrincipal .="<a href='infoJuego.php?idJuego=$id'>$nombre</a>";
                        if(Juego::buscarJuegoReb($id)){ 
                            $contenidoPrincipal .= "<div class = tachar>";
                            $contenidoPrincipal .=" $precio €";
                            $contenidoPrincipal .="</div>";
                            $reba = Juego::buscarJuegoNombreReb1($id);
                            $contenidoPrincipal .=" $reba €<br>";
                            }
    
                        else{
                            $contenidoPrincipal .=" <br>$precio €<br><br>";
                        }
                        $contenidoPrincipal .="</div>";
                    }
                    
                }
        $contenidoPrincipal.="</div>";

$contenidoPrincipal.=<<<EOS
    </div>
    </div>
EOS;




require __DIR__ . '/includes/vistas/plantillas/plantillaUser.php';
?>

