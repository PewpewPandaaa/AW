<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';

class FormAnnadirAmigo extends Formulario
{

    private $solicitante;
    private $id;


    public function __construct($ids, $id) {
        $x= Usuario::buscaPorId($id);
        $nombre = $x->getNombreUsuario();
        parent::__construct('FormAnnadirAmigo'.$id, ['urlRedireccion' => 'perfil.php?idUser='.$nombre]);
        $this->solicitante = $ids;
        $this->id = $id;
    }

    protected function generaCamposFormulario(&$datos){

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        $html = <<<EOF
        $htmlErroresGlobales
        <div>
            <input type="hidden" name ="annadir" value="$this->id" />
            <button type="submit" name="annadir">Añadir Amigo</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        $annadir = Amigo::solicitudAmigo($this->solicitante, $this->id); 
        
    }



}


?>