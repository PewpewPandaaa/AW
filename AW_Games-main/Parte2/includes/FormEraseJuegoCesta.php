<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Juego.php';

class FormEraseJuegoCesta extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        parent::__construct('FormEraseJuegoCesta'.$idJuego,  ['urlRedireccion' => 'carrito.php']);
        $this->idJuego = $idJuego;
        
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
        <input type="hidden" name ="eliminar" value="$this->idJuego" />
        <button type="submit" name="eliminar"> Eliminar</button>
        </div>
        
        EOF;
        return $html;
    }
    
    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){
            $us=Usuario::buscaUsuario($_SESSION["username"]);

            $borrarGame = UsuarioCesta::eliminarJuegoEnCesta($this->idJuego, $us->getId()); 
        }
        
    }



}


?>