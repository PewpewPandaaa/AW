<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw as path;

require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Comunidad';
$contenidoPrincipal = "";



$gm = Juego::getJuegos();
if (isset($_SESSION["login"])) {
  $us = Usuario::buscaUsuario($_SESSION["username"]);
  $gmU = UsuarioG::getJuegoPorUsuario1($us->getId());
  $tamaño = count($gmU);
  if ($tamaño >= 1) {

    $contenidoPrincipal .= '<div id="contenido_gestion_user"><div class="titulo-comunidad">Comunidades de mis juegos</div><div class="container-mainJuego">
<div class="container-comunidad-juego">';

    foreach ($gmU as $gm_nameU) {

      $contenidoPrincipal .= <<<EOS

  <a class='linkComunidad' href='comunidadJuego.php?idJuego={$gm_nameU['id']}'><div class="comunidad-juego-container">

    <div class="img-comunidad-container">

      <img class="img-comunidad" src="img/juegos/{$gm_nameU['juego']->getRutaImagen()}">

    </div>

    <div class="titulo-container"> <p>{$gm_nameU['juego']->getNombre()}</p> </div>

  </div></a>


EOS;
    }
    $contenidoPrincipal .= '</div></div>';
  }
}
$contenidoPrincipal .= '<div class="titulo-comunidad">Toda las comunidades</div><div class="container-mainJuego">
<div class="container-comunidad-juego">';

foreach ($gm as $gm_name) {
  $contenidoPrincipal .= <<<EOS

      
  <a class='linkComunidad' href='comunidadJuego.php?idJuego={$gm_name->getIdJuego()}'><div class="comunidad-juego-container">

    <div class="img-comunidad-container">

      <img class="img-comunidad" src="img/juegos/{$gm_name->getRutaImagen()}">

    </div>

    <div class="titulo-container"> <p>{$gm_name->getNombre()}</p> </div>

  </div></a>

          
EOS;
}
$contenidoPrincipal .= '</div>';

require __DIR__ . '/includes/vistas/plantillas/plantillaUser.php';
