<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Juego.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';

class FormEliminarComunidad extends Formulario
{

    private $idJuego;
    private $idComentario;

    public function __construct($idJuego,$idComentario) {
        $this->idJuego = $idJuego;
        $this->idComentario=$idComentario;
        parent::__construct('FormEliminarComunidad'.$idJuego.$idComentario, ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'comunidadJuego.php?idJuego='.$this->idJuego]);//por ahora queda mas claro asi
        
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.

       $html = <<<EOF
            $htmlErroresGlobales
            <button type="submit" class="botonEliminar"> Eliminar </button>
            EOF;

        return $html;
    }


    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){

            Comentarios::eliminarComentario($this->idComentario);
        }
    }



}
