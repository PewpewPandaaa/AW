<?php
use es\ucm\fdi\aw\Juego;
use es\ucm\fdi\aw\FormAnnadirCarro;
use es\ucm\fdi\aw\UsuarioG;
use es\ucm\fdi\aw\UsuarioCesta;
use es\ucm\fdi\aw\Usuario;

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/Juego.php';
$tituloPagina = 'AWSD_Tienda';

$contenidoPrincipal = '';
$op="all";
$filtro="all";
$cat = isset($_GET['categ']) ? htmlspecialchars(trim(strip_tags($_GET['categ']))) : null;
$nombre=isset($_GET["buscar"]) ? htmlspecialchars(trim(strip_tags($_GET["buscar"]))):null;
$ordenar=isset($_POST["ordenar"]) ? htmlspecialchars(trim(strip_tags($_POST["ordenar"]))):null;
if($ordenar==null && $cat!=null){
    $result =Juego::buscarJuegoAllGenero($cat);
    $op="categ";
    $filtro=$cat;
}
else if($ordenar==null && $nombre!=null){
    $op="buscar";
    $filtro=$nombre;
    $result=Juego::buscarJuego("%$nombre%");
    
}
else if($cat!=null&&$ordenar!=null){
    $result=Juego::filtrarCategoriaJuego($ordenar,$cat);
    $op="categ";
    $filtro=$cat;
}
else if($nombre!=null&&$ordenar!=null){
    $op="buscar";
    $filtro=$nombre;
    $result=Juego::filtrarBusquedaJuego($ordenar,"%$nombre%");
    
}
else if ($ordenar!=null&& $cat==null && $nombre==null) {
    $result=Juego::filtrarJuego($ordenar);
}
else {
    $result =Juego::getJuegos();
}


$contenidoPrincipal .="<div id='container'>"; 

//categoria
$contenidoPrincipal .="<div id='categoria'>";
$sql_categorias=Juego::getAllGenero();
$contenidoPrincipal .="<ul>";
foreach($sql_categorias as $categoria){

	$contenidoPrincipal .= "<div class=categoria_link>";
	$contenidoPrincipal .= "<li><a href='tienda.php?categ=$categoria'>$categoria</a></li><br>";
	$contenidoPrincipal .="</div>";
}
$contenidoPrincipal .="</ul>";
$contenidoPrincipal .="</div>";

//buscar
$contenidoPrincipal .="<div id='buscador'>";
$contenidoPrincipal .="<form action='tienda.php' method='get'>";
$contenidoPrincipal .="<p>
    <input type='text' size='23' name='buscar' placeholder='$nombre'>

    <button type='submit'>Buscar</button>

  </p>";

$contenidoPrincipal .="</form>";
$contenidoPrincipal .="</div>";

//filtro
$contenidoPrincipal .="<div id='filtro'>"; 
$contenidoPrincipal .="<form  action='tienda.php?$op=$filtro' method='post'>
        <p>Ordenar por:</p>
        <br>
        <br>
			<select name='ordenar'>
				<option value='1'>Orden alfabético (A-Z)</option>
				<option value='2'>Orden alfabético inverso</option>
				<option value='3'>Precio más bajo a más alto</option>
				<option value='4'>Precio más alto a más bajo</option>					
			</select>
			<button type='submit'>Aplicar</button>
		</form>";
  if($ordenar!=null){
    if($ordenar==1){
        $contenidoPrincipal .="<h4><br><br>Orden: Alfabético (A-Z)</h4>";
    }
    else if($ordenar==2){
        $contenidoPrincipal .="<h4><br><br>Orden: Alfabético inverso</h4>";
    }
    else if($ordenar==3){
        $contenidoPrincipal .="<h4><br><br>Orden: Precio más bajo a más alto</h4>";
    }
    else if($ordenar==4){
        $contenidoPrincipal .="<h4><br><br>Orden: Precio más alto a más bajo</h4>";
    }
  }   
 $contenidoPrincipal .="</div>";
 
//producto
$contenidoPrincipal .="<div id='producto'>";
            if (count($result) > 0) {
                // mostramos los datos de cada fila
                foreach($result as $row) {
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
                    
                    if(isset($_SESSION["login"]) && !$_SESSION['esAdmin']){
                        $formE = new FormAnnadirCarro($id);
                        $htmlFormCarro = $formE->gestiona();

                        $us=Usuario::buscaUsuario($_SESSION["username"]);
                        
                        if(UsuarioCesta::buscarEnCesta($us->getId(), $id)){
                            $contenidoPrincipal .=" <div> Añadido en carrito </div><br>";
                    
                        }else if(UsuarioG::buscarEnUsuarioJuego($us->getId(), $id)){
                            $contenidoPrincipal .="<div> Juego comprado </div> <br>";
                        }else{
                           
                            $contenidoPrincipal .=" $htmlFormCarro <br><br>";
                        }
                    }
                    
                    $contenidoPrincipal .="</div>";
                }
            }
            $contenidoPrincipal .="</div>";

$contenidoPrincipal .="</div>";
require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>