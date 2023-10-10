<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';

class FormRechazarAmigo extends Formulario
{

    private $idSolicitado;
    private $idSolicitante;

    public function __construct($id1, $id2) {
        parent::__construct('FormRechazarAmigo'.$id1, ['urlRedireccion' => 'solicitud.php']);//por ahora queda mas claro asi
        $this->idSolicitante = $id1;
        $this->idSolicitado = $id2;
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
            <input type="hidden" name ="rechazar" value="$this->idSolicitado" />
            <button type="submit" name="rechazar">Rechazar</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        // FALTA
        Amigo::borrarSolicitud($this->idSolicitante,$this->idSolicitado);
    }



}


?>