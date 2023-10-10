<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Report.php';

class FormEraseReport extends Formulario
{   
    private $id;

    public function __construct($id) {
        $this->id = $id;
        parent::__construct('FormEraseReport', ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'BuzonReport.php']);//por ahora asi, no me va que vuelva al juego
        
    }
    protected function generaCamposFormulario(&$datos)
    {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
  
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.

        $html = <<<EOF
        $htmlErroresGlobales
        <div>
        <input type="hidden" name ="eliminar" value="$this->id" />
        <button type="submit" id="botonElimReport"> Eliminar </button>
        </div>

        EOF;       
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {   
       Report::borrarReport($this->id);
    }


}


?>