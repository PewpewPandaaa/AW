<?php
use es\ucm\fdi\aw as path;
require_once __DIR__.'/includes/config.php';

  $tituloPagina ='Inicio AWSD';
  $contenidoPrincipal = "";
  $claseArticle = 'index';
  $contenidoPrincipal .= "<div class='bg-1'>";

  $contenidoPrincipal .= "<h1>";
  $contenidoPrincipal .= "<div class = 't'>";
  $contenidoPrincipal .= "<p>AWSD</p>";
  $contenidoPrincipal .= "<p> ";
  $contenidoPrincipal .= "<span class='word wisteria'>Juega</span>";
  $contenidoPrincipal .= "<span class='word belize'>Comparte</span>";
  $contenidoPrincipal .= "<span class='word pomegranate'>Chatea</span>";
  $contenidoPrincipal .= "<span class='word green'>Disfruta</span>";
  $contenidoPrincipal .= "</p> ";
  $contenidoPrincipal .= "<script src='js/title.js'> </script>";
  $contenidoPrincipal .= "</div>";
  $contenidoPrincipal .= "</h1>";

  $contenidoPrincipal .= "<div class = 'inicio_text'>";
  $contenidoPrincipal .= "</div>";

  $contenidoPrincipal .= "<div class = 'juegos'>";
  $contenidoPrincipal .= "<div class='contenedor-principal'>";
  $contenidoPrincipal .= "<div class = 'carousel-container'>";
  $contenidoPrincipal .= "<div class = 'carousel-inner'>";
  $arrayJuegos = path\Juego::getJuegos();
  shuffle($arrayJuegos);

  foreach ($arrayJuegos as $key => $juego){

    $img="img/juegos/";
    $ruta = $juego->getRutaImagen(); //ruta
    $id = $juego->getIdJuego();

    $contenidoPrincipal .= "<div class='carousel-item'>";
    $contenidoPrincipal .= "<a href='infoJuego.php?idJuego=$id'><img src='".$img.$ruta."'></a>";

    $contenidoPrincipal .= "</div>";
  }
  $contenidoPrincipal .= "</div>"; //cierre carousel
  $contenidoPrincipal .= "</div>";
  $contenidoPrincipal .= "</div>"; //cierre contenedor juegos
  $contenidoPrincipal .= "</div>"; //cierre de juegos

  $contenidoPrincipal .="</div>";

  require __DIR__.'/includes/vistas/plantillas/plantillaIndex.php'



?>