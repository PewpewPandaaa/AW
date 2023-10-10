<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';

class FormBorrarAmigo extends Formulario
{

    private $id;
    private $id_user;

    public function __construct($id_user, $id) {
        parent::__construct('FormBorrarAmigo'.$id_user, ['urlRedireccion' => 'amigo.php']);//por ahora queda mas claro asi
        $this->id = $id;
        $this->id_user = $id_user;
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
            <input type="hidden" name ="eliminar" value="$this->id" />
            <button type="submit" name="eliminar">Eliminar Amigo</button>
        </div>
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        
        $borrar = Amigo::borrarAmigo($this->id_user, $this->id);
        
    }



}


?>