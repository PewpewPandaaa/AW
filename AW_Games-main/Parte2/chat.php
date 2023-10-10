<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

$idUs = isset($_GET["idUs"]) ? htmlspecialchars(trim(strip_tags($_GET["idUs"]))) : 0;
$amigo=Usuario::buscaPorId($idUs);
$tituloPagina = 'Chat';

$contenidoPrincipal= ' ';

$formF = new FormChatFriend($idUs);
$htmlFormChatFriend = $formF->gestiona();


if(isset($_SESSION["login"])){

    $me=Usuario::buscaUsuario($_SESSION["username"]);
    $m = MensajesChat::getAllMesanjes($me->getId(),$idUs);

    $contenidoPrincipal .= <<<EOS
        <div id="contenido">
            <div class="id_container">
                <a href ="amigo.php" >
                    <img id="volver_atras" src="img/volver.png">
                </a>
                <div id="dir_msg"> Mensajes a {$amigo->getNombre()}    </div>
           
            </div>
    EOS;

    if(sizeof($m)== 0){
    
        $contenidoPrincipal .= <<<EOS
            <div id="contenido_chat">
                <p> Ya puedes empezar la conversación!!</p>
        EOS;

    }else{
        
        $contenidoPrincipal .=<<<EOS
            <div id="contenido_chat">
                <div class="conv_bubble">
        EOS;
    }


    foreach ($m as $message){

        if($message->getIdEnviado() == $me->getId()){
            $contenidoPrincipal .=<<<EOS
    
                    <div id="box">
                        <div id="right_box">
                            <div>{$message->getMensaje()} </div>
                        </div>
                    </div>
            EOS;
    
    }else{
            $contenidoPrincipal .=<<<EOS
                    <div id="box">
                        <div id="left_box">
                            <div>{$message->getMensaje()}</div>
                        </div>
                    </div>
            EOS;
    }
    
   
    }

    
    $contenidoPrincipal .= <<<EOS
        </div>
            </div>
        
            <div id="chat_wrapper"> 
                <div class="container-comentt" >
                    $htmlFormChatFriend
                </div>
            </div>   
        </div>
EOS;

}

  



require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>