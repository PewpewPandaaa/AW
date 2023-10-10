<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormAnnadirAmigo.php';

$tituloPagina = 'Mis datos';

$contenidoPrincipal = '';

$idUser = isset($_GET["idUser"]) ? htmlspecialchars(trim(strip_tags($_GET["idUser"]))) : 0;
$us=Usuario::buscaUsuario($idUser);


if(isset($_SESSION["login"])){

  $me=Usuario::buscaUsuario($_SESSION["username"]);


  $contenidoPrincipal = <<<EOS
   
    <div id="contenido" >

  EOS;

  if($us==$me){
    $contenidoPrincipal .= <<<EOS
      <div id="btn-container">
        <div id="btn-right-up">
          <a href="modify.php">Modificar</a>
        </div>
      </div>
    EOS;

  }else{
    $contenidoPrincipal .= <<<EOS
      <div id="btn-container">
        <div id="btn-right-up">
    EOS;
    
    $formA = new FormAnnadirAmigo($me->getId(),$us->getId());
    $htmlFormAnnadirUs = $formA->gestiona();
    if(Amigo::UsuarioAmigo($me->getId(),$us->getId())){ //comprobar si ya son amigos
                
      $contenidoPrincipal .=<<<EOS
              <div> ya sois amigos </div>
      EOS;
    }
    else if(Amigo::yaSolicite($me->getId(),$us->getId())){ // comprobar si haya solicitado o no
        
        $contenidoPrincipal .=<<<EOS
                <div> ¡Espera respuesta! </div>
        EOS;
    }
    else{
        $contenidoPrincipal .=<<<EOS
                $htmlFormAnnadirUs
        EOS;
    }
    $contenidoPrincipal .= <<<EOS
      </div>
    </div>
    EOS;

  }
  $contenidoPrincipal .= <<<EOS
      
      <div id="user_content_wrapper">
  
  EOS;

  if($us->getimagen1()!=NULL) {

    $contenidoPrincipal .= <<<EOS
      
        <div class="avatar_wrapper">
          <img class="avatar-img" src="data:image/jpeg;base64,{$us->getimagen($us->getId())}" alt="avatar">
        </div>

    EOS;

  }else{
    
    $contenidoPrincipal .= <<<EOS
        
        <div class="avatar_wrapper">
          <img class="avatar-img" src="img/avatar.png" alt="avatar">
        </div>
    
    EOS;
  }
  
  $contenidoPrincipal .= <<<EOS
      
        <div class="user_basic">
          <span id="user_info">
            <div id="user">{$us->getNombre()} 
  EOS;

  if($us->getgenero() == "femenina"){
    
    $contenidoPrincipal .= <<<EOS
              <img class="genero-img" src="img/mujer.png" alt= "mujer">
    EOS;

  }else if($us->getgenero() == "masculino"){
    
    $contenidoPrincipal .= <<<EOS
              <img class="genero-img" src="img/hombre.png" alt= "hombre">
    EOS;
  
  }

  $gm=UsuarioG::getJuegoPorUsuario($us->getId());
  $g = sizeof($gm);

  $fd=Amigo::getAmigoPorUsuario($us->getId());
  $f = sizeof($fd);


  $contenidoPrincipal.=<<<EOS
          </div>
          
          <div class="logros">
            <div class="n-juegos">
              <div class="type1">NºJuegos
                  <span class="type2">{$g}</span>
              </div>  
            </div>

            <div class="n-amigos">
              <div class="type1">NºAmigos
                <span class="type2">{$f}</span>
              </div>
            </div>
EOS;



  $contenidoPrincipal.=<<<EOS
          
          </div>
        
          <div id ="fecha_wrapper">
            <div id="fecha_creacion">con nosotros desde {$us-> getfecha()} </div>
          </div>    
      
        </span>
      </div>
    </div>
  
      
  
  <div id="user_info_wrapper">
    <div id="title">Sobre mí</div>
    
    <div id="lema-wrapper">
      <div id="lema">{$us->getlema()}</div>
    </div>
  </div>
  
  EOS;
  }
    require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
  ?>