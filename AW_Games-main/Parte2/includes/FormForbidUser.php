<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/config.php';

class FormForbidUser extends Formulario
{

    private $id;
    private $fecha;

    public function __construct($id, $fecha) {
        parent::__construct('FormForbidUser'.$id, ['urlRedireccion' => 'GestionarUsuario.php']);//por ahora queda mas claro asi
        $this->id = $id;
        $this->fecha = $fecha;
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <div>
            <input type="hidden" name ="prohibido" value="$this->id" />
            <button type="submit" name="prohibido">&nbsp;Mutear&nbsp;</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        //Mutear
    
        Usuario::muteUser($this->id,$this->fecha);
    }



}


?>