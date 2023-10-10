<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Juego.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/UsuarioG.php';

class FormValorGame extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        $this->idJuego = $idJuego;
        parent::__construct('FormValorGame'.$idJuego, ['urlRedireccion' => 'infoJuego.php?idJuego='.$this->idJuego]);//por ahora queda mas claro asi
        
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
       $juego = Juego::buscarJuegoNombrePorId($this->idJuego);
       $media = $juego->getValoracion();
        $html = <<<EOF
            $htmlErroresGlobales
            <div class="estrella1">
                <input id="radio11" type="radio" name="estrellas" value="5"
        EOF;
                if ($media >= 5) { $html .= " checked"; } 
        $html .= <<<EOF
                disabled>
                <label for="radio11">★</label>
                <input id="radio12" type="radio" name="estrellas" value="4"
        EOF;
                if ($media >= 4 && $media < 5) { $html .= " checked"; } 
        $html .= <<<EOF
                disabled>
                <label for="radio12">★</label>
                <input id="radio13" type="radio" name="estrellas" value="3"
        EOF;
                if ($media >= 3 && $media < 4) { $html .= " checked"; } 
        $html .= <<<EOF
                disabled>
                <label for="radio13" >★</label>
                <input id="radio14" type="radio" name="estrellas" value="2"
        EOF;
                if ($media >= 2 && $media < 3) { $html .= " checked"; } 
        $html .= <<<EOF
                disabled>
                <label for="radio14">★</label>
                <input id="radio15" type="radio" name="estrellas" value="1"<
        EOF;
                if ($media >= 1 && $media < 2) { $html .= " checked"; } 
        $html .= <<<EOF
                disabled>
                <label for="radio15">★</label>
                <p> $media ★ </p>
            </div>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {

    }

}


?>