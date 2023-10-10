<?php
namespace es\ucm\fdi\aw;

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/Usuario.php';
require_once __DIR__ . '/includes/Report.php';


$tituloPagina = 'Buzón de Reports';

$contenidoPrincipal = '';


if (isset($_SESSION["login"]) && $_SESSION['esAdmin']) {


    $arrayReports = Report::getTodosReport();
    $tamaño = count($arrayReports);
    
     if($tamaño>2){
    $contenidoPrincipal=<<<EOS
    <div id="contenido_gestion_admin">
    <!--<div id="contenido">-->
    EOS;
    }else{
    $contenidoPrincipal=<<<EOS
    <div id="contenido_gestion_admin_noScroll"> 
    EOS;
    }
    $contenidoPrincipal .= <<<EOS
    <div class = "games_basic">
              <span id = "games_info"> 
                  <div id = "title">Buzón de reports</div>
              </span>
        </div>
    <div id="contenido-admin">
    EOS;


    if ($tamaño == 0) {
        $contenidoPrincipal = <<<EOS
        <div class="juego_container">
            <p> Actualmente no hay reports pendientes </p>
        </div>
        </div>
    EOS;
    }

    if ($tamaño > 0) {

        $contenidoPrincipal .= <<<EOS
        <table>
        <thead>
            <tr>
                    <th>ID Usuario</th>
                    <th>Nombre Usuario</th>
                    <th>Usuario reportado</th> 
                    <th>Comentario</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
            </tr>
        </thead>

        <tbody>    
    
        EOS;

        foreach ($arrayReports as $key => $report) {

            $formE = new FormEraseReport($report->getIdReport());
            $htmlFormEliReport = $formE->gestiona();

            $usuarioReportado = Usuario::buscaPorId($report->getIdUsuario());
            $idUsuario = Usuario::buscaUsuario($report->getnombreUsuaio());

            $contenidoPrincipal .= <<<EOS
            <tr>
            <td>{$idUsuario->getId()} </td>
            <td>{$report->getnombreUsuaio()}</td>
            <td>{$usuarioReportado->getNombreUsuario()}</td>
            <td>{$report->getComentario()}</td>
            <td>{$report->getmotivo()}</td>
            <td>{$report->getfecha()}</td>
            <td>
                <div id="button_container">
                    <div  id="botonElimReport">
                    $htmlFormEliReport
                    </div>
                </div>
            </td>
           
            </tr>
  
            EOS;
        }

        $contenidoPrincipal .= <<<EOS
        
        </tbody>
        </table>
        EOS;
    }

}


require __DIR__ . '/includes/vistas/plantillas/plantillaUser.php';
?>