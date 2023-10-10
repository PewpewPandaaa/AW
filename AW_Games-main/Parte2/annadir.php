<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormAnnadirAmigo.php';

$tituloPagina = 'Añadir Amigo';

$contenidoPrincipal = '';


if(isset($_SESSION["login"])){
 
    $me=Usuario::buscaUsuario($_SESSION["username"]);
    $us=Usuario::getUsuarios();
    $meId=$me->getNombreUsuario();
 
    $contenidoPrincipal=<<<EOS
    
        <div id="contenido_gestion_user">
            <div id="seleccionar_annadir_buscar">
                <div id="selec_content">
                    <a href="amigo.php" class="icono"> 
                        <img src="img/amigos.png" title="Mis amigos" id="amigosLink">
                    </a>
                    <p></p>
                    <a href="annadir.php" class="icono">
                        <img src="img/anadir.png" title="Añadir amigos" id="xLink">
                    </a>
                </div>
            </div>
            <div id="titulo_user"> Añadir amigos </div>
            <div id="friend_search">
                <input onkeyup="buscar_ahora($('#buscar_1').val());"type="text" placeholder="Buscar por nombre" id="buscar_1">   
            </div>
            <div id="search-instruction" class="search-instruction">
                    <p>Escribe el nombre de usuario que deseas buscar</p>
                </div>
            <div id="datos_buscador">
            <input type="hidden" id="x" value="$meId">;
            </div>
    EOS;

    
    $s = 0;    
    
    /*foreach ($us as $us_info){
        $formA = new FormAnnadirAmigo($me->getId(),$us_info->getId());
        $htmlFormAnnadirUs = $formA->gestiona();

        if($_SESSION["username"] == $us_info->getNombreUsuario()){ // si coincide con el id, no muestra nada
            $contenidoPrincipal .= '';
        
        }else if($us_info->tieneRol(USUARIO::ADMIN_ROLE)){ //si es admin tampoco, ya que administradores no tienen amigos
            $contenidoPrincipal .= '';
        
        }else{
        
            if($s>0){
                $contenidoPrincipal .=<<<EOS
                <hr>
                EOS;
            }

            $contenidoPrincipal .=<<<EOS
                <div id = "Juego_wrapper" class="games">
                    <div id="btn-m-up">
            EOS;
       
            if(Amigo::UsuarioAmigo($me->getId(),$us_info->getId())){ //comprobar si ya son amigos
                
                $contenidoPrincipal .=<<<EOS
                        <div> ya sois amigos </div>
                EOS;
            }
            else if(Amigo::yaSolicite($me->getId(),$us_info->getId())){ // comprobar si haya solicitado o no
                
                $contenidoPrincipal .=<<<EOS
                        <div> ¡Espera respuesta! </div>
                EOS;
            }
            else{
                $contenidoPrincipal .=<<<EOS
                        $htmlFormAnnadirUs
                EOS;
            }

            $contenidoPrincipal .=<<<EOS
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
                               
                    EOS;
                }else if($us_info->getgenero() == "masculino"){
                    $contenidoPrincipal .= <<<EOS
                                    <img class="genero-img" src="img/hombre.png" alt= "hombre">
                               
                    EOS;
                }
                
                $contenidoPrincipal .=<<<EOS
                                </span>
                            </div>
                        </span>
                    </div>
                </div>
                   
        
        
        EOS;
        $s++;
            }
  
  
}
    $contenidoPrincipal .=<<<EOS
            </div>
    EOS;

}*/
}

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>