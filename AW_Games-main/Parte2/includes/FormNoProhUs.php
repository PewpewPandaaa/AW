<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/config.php';

class FormNoProhUser extends Formulario
{

    private $id;

    public function __construct($id) {
        parent::__construct('FormNoProhUser'.$id, ['urlRedireccion' => 'GestionarUsuario.php']);//por ahora queda mas claro asi
        $this->id = $id;
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
            <button type="submit" name="prohibido">No Mutear</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        //Mutear
        $fecha = getdate();
        Usuario::noMute($this->id);
    }



}


?>