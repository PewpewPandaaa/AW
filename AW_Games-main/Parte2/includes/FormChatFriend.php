<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';

class FormChatFriend extends Formulario
{

    private $id_recibido;

    public function __construct($idR) {
        parent::__construct('FormChatFriend', ['urlRedireccion' => 'chat.php']);
        $this->id_recibido = $idR;
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
      
            <input id="message" name="message" placeholder="Escribe algo..."></textarea>
            <button type="submit" name="enviar">Enviar</button>
        
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {

        $message = filter_var($datos['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $message || empty($infoUser) ) {
            $this->errores['message'] = 'No puedes enviar algo vacío';
        }

        $us=Usuario::buscaUsuario($_SESSION["username"]);
        MensajesChat::InsertarMensaje($us->getId(),$this->id_recibido, $message);
        
    }



}


?>