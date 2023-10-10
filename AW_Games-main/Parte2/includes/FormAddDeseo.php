<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Juego.php';

class FormAddDeseo extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        parent::__construct('FormAddDeseo'.$idJuego,  ['urlRedireccion' => 'listadeseo.php']);
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
        <input type="hidden" name ="anniadir" value="$this->idJuego" />
        <button type="submit" name="anniadir"> Añadir a lista de deseos </button>
        </div>
        
        EOF;
        return $html;
    }
    
    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){
            $us=Usuario::buscaUsuario($_SESSION["username"]);

            $juego = Juego::buscarJuegoNombrePorId($this->idJuego);
            $nomJuego=$juego->getNombre();

            $anniadir = Juego::insertarJuegoDes($us->getId(),$this->idJuego,$nomJuego);
        }
        
    }



}


?>