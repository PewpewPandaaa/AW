<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormBorrarAmigo.php';

$tituloPagina = 'Mis amigos';

$contenidoPrincipal = '';

if(isset($_SESSION["login"])){
 // $usId = $_SESSION['username'];
 $us=Usuario::buscaUsuario($_SESSION["username"]);
 $a = Amigo::getAmigoPorUsuario($us->getId());

 
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
    EOS;
    
    if(sizeof($a)>0){
    $contenidoPrincipal.=<<<EOS
        <div id="titulo_user"> Mis amigos </div>
    EOS;
    }

 if(sizeof($a)== 0){
   
    $contenidoPrincipal .= <<<EOS
        <div id="contenido">
            <div id="suggestion_add">
                <p> ¡Agrega amigos! </p>
                <p> (pulsando 
                    <a href="annadir.php">aqui </a> o pulsando al icono de arriba) </p>
            </div>
        </div>
    </div>
    
EOS;
}

else {

    $s = 0;   
  foreach ($a as $a_info){
    $idUs=$a_info->getId();
    $nombreUs = $a_info->getNombreUsuario();
    $formB = new FormBorrarAmigo($us->getId(),$idUs);
    $htmlFormBorrarA = $formB->gestiona();

    if($s>0){
        $contenidoPrincipal .=<<<EOS
        <hr>
        EOS;
    }
  
    $contenidoPrincipal .=<<<EOS
        <div id = "Juego_wrapper" class="games">
            <div id="btn-m-up">
                $htmlFormBorrarA
                <br>
                <a href='chat.php?idUs={$idUs}'>Chatear </a>
            </div>
            
           
            <div class="avatar_wrapper"> 
    EOS;

    if($a_info->getimagen($a_info->getId())==NULL){ //Si hay información de avatar en base de datos
            
        $contenidoPrincipal .= <<<EOS
        <a href='perfil.php?idUser=$nombreUs'>
                <img class="user-img" src="img/avatar.png" alt="juego">
        </a>
        EOS;

    }
    else{
            
        $contenidoPrincipal .= <<<EOS
        <a href='perfil.php?idUser=$nombreUs'>
                <img class="user-img" src="data:image/jpeg;base64,{$a_info->getimagen($a_info->getId())}" alt="juego">
        </a>
        EOS;
        
    }            
            
        $contenidoPrincipal .= <<<EOS
            </div> 
            
            <div class="title_game_wrapper">
                <span id = "game_info"> 
                    <div id="game_container_time">
                        <span id = "game">{$a_info->getNombre()}  
        EOS;

    if($a_info->getgenero() == "femenina"){  //Si ha proporcionado ya sobre su genero.
        
        $contenidoPrincipal .= <<<EOS
                            <img class="genero-img" src="img/mujer.png" alt= "mujer">
                        </span>
        EOS;
    
    }else if($a_info->getgenero() == "masculino"){
        
        $contenidoPrincipal .= <<<EOS
                            <img class="genero-img" src="img/hombre.png" alt= "hombre">
                        </span>
        EOS;
    }

        //Cerrar todas las etiquetas abiertas
        $contenidoPrincipal .=<<<EOS
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