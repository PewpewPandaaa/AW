<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';

class FormAceptarAmigo extends Formulario
{

    private $idSolicitado;
    private $idSolicitante;

    public function __construct($id1, $id2) {
        parent::__construct('FormAceptarAmigo'.$id1, ['urlRedireccion' => 'solicitud.php']);
        $this->idSolicitado = $id2;
        $this->idSolicitante = $id1;
    }

    protected function generaCamposFormulario(&$datos){

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $html = <<<EOF
        $htmlErroresGlobales

        <div>
            <input type="hidden" name ="annadir" value="$this->idSolicitado" />
            <button type="submit" name="annadir">Aceptar</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos){
        
        Amigo::borrarSolicitud($this->idSolicitante,$this->idSolicitado);
        Amigo::annadirAmigo($this->idSolicitante,$this->idSolicitado);
        
    }


}


?>