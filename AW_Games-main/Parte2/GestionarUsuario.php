<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormEraseUser.php';
require_once __DIR__.'/includes/FormForbidUser.php';
require_once __DIR__.'/includes/FormNoProhUs.php';

$tituloPagina = 'Gestionar Usuario';

$contenidoPrincipal = '';



if(isset($_SESSION["login"]) && $_SESSION["esAdmin"]){
  
    $usId = $_SESSION['username'];
    $us=Usuario::getUsuarios();
  
  //Control de usuarios con scroll
 
    $contenidoPrincipal=<<<EOS
        <div id="contenido_gestion_admin"> 
    EOS;

  
    $s = 0; //Para control si hay que poner barra.
  
    foreach ($us as $us_info){

    $fecha_actual = date("Y-m-d");


    $formE = new FormEraseUser($us_info->getId());
    $formP = new FormForbidUser($us_info->getId(),$fecha_actual);
    $formN = new FormNoProhUser($us_info->getId());
    $htmlFormBorrarUs = $formE->gestiona();
    $htmlFormProhUs = $formP->gestiona();
    $htmlFormNoProhUs = $formN->gestiona();

    if($s>0){
        $contenidoPrincipal .=<<<EOS
        <hr>
    EOS;
    }

    //Si coincide con su propio id no muestra. 
    if($usId == $us_info->getNombreUsuario()){
        
        $contenidoPrincipal .= '';
    
    }
    else{ 

        $contenidoPrincipal .=<<<EOS
            <div id = "Juego_wrapper" class="games">
                <div id="btn-m-up">
                    $htmlFormBorrarUs
        EOS;

        //Si está en la tabla muteado o no
        if(!Usuario::isMute($us_info->getId())){
        
            $contenidoPrincipal .=<<<EOS
                    $htmlFormProhUs
                </div>
        
        EOS;
        
        }else{
        
            $contenidoPrincipal .=<<<EOS
                    $htmlFormNoProhUs
                </div>
                
                
        EOS;
        }

        $contenidoPrincipal .= <<<EOS
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
                        
                        <div id= "user_id"> El id de este usuario es: {$us_info->getId()}</div>
                        
                        <div id="price_wrapper">
                                <span id = "precio">Desde {$us_info->getfecha()} </span>
                        </div>
                    </span>
                </div>
            </div>    
       
        EOS;
        
    $s++;
    }
}
  
}


require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>