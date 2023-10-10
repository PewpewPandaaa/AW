<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormAceptarAmigo.php';


$tituloPagina = 'Buzon de solicitud';

$contenidoPrincipal = '';


if(isset($_SESSION["login"])){
  
  //$us=Usuario::getUsuarios();
  $us=Usuario::buscaUsuario($_SESSION["username"]);
  $s=Amigo::misSolicitudes($us->getId());

    

  
    $contenidoPrincipal=<<<EOS
        <div id="contenido_gestion_admin">    
    EOS;
       

  if(sizeof($s)==0 ){
    $contenidoPrincipal=<<<EOS
            <div class="juego_container">
                <div id="empty">
                    <p> ¡No tienes ninguna solicitud nueva! </p>
                </div>
            </div>
        </div>
    EOS;
  }
  
  foreach ($s as $us_info){
    
    $formA = new FormAceptarAmigo($us_info->getId(), $us->getId());
    $formR = new FormRechazarAmigo($us_info->getId(), $us->getId());
    $htmlFormAceptarUs = $formA->gestiona();
    $htmlFormRechazUs = $formR->gestiona();

    $contenidoPrincipal .=<<<EOS
            
            <div id = "Juego_wrapper" class="games">
                <div id="btn-m-up">
                    $htmlFormAceptarUs
                    $htmlFormRechazUs
                </div>
                
                <div class="avatar_wrapper"> 
    EOS;
        
    if($us_info->getimagen($us_info->getId())==NULL){
        
        $contenidoPrincipal .= <<<EOS
                    <img class="user-img" src="img/avatar.png" alt="juego">
        EOS;

    }else{
            
        $contenidoPrincipal .= <<<EOS
                    <img class="user-img" src="data:image/jpeg;base64,{$us_info->getimagen($us_info->getId())}" alt="juego">
        EOS;
    }            
           
    $contenidoPrincipal .= <<<EOS
                </div>
                    
                <div class="title_game_wrapper">
                    <span id = "game_info"> 
                        <div id="game_container_time">
                            <span id = "game">{$us_info->getNombre()}  
    EOS;
            
    if($us_info->getgenero() == "femenina"){
                
        $contenidoPrincipal .= <<<EOS
                                <img class="genero-img" src="img/mujer.png" alt= "mujer">
                            </span>
        EOS;
    
    }else if($us_info->getgenero() == "masculino"){
              
        $contenidoPrincipal .= <<<EOS
                                <img class="genero-img" src="img/hombre.png" alt= "hombre">
                            </span>
        EOS;
    }
              
    $contenidoPrincipal .=<<<EOS
                        </div>
                    </span>
                </div>
            </div>         
    EOS;
    }

    $contenidoPrincipal .=<<<EOS
        </div>         
    EOS;
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>

