<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormReportComment.php';

$tituloPagina = 'Reportar un comentario';

$id = isset($_GET['idComentario']) ? htmlspecialchars(trim(strip_tags($_GET["idComentario"]))) : 0;
$comentario = Comentarios::buscarComentario($id);

$form = new FormReportComment($id,$comentario->getIdJuego());
$htmlFormReportComment = $form->gestiona();
$contenidoPrincipal = '';

$contenidoPrincipal = '';



if(isset($_SESSION["login"])){

    $contenidoPrincipal = <<<EOS
    <div id="contenido_modif">

    $htmlFormReportComment

    </div>
    EOS;
}else{

    $contenidoPrincipal = <<<EOS
    <div id="contenido_modif">
        <h1>Tiene que inicia sesión para comentar</h1>
    </div>
    EOS;

}



require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>