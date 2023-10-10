<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Juego.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';

class FormDeleteComent extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        $this->idJuego = $idJuego;
        parent::__construct('FormDeleteComent'.$idJuego, ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'infoJuego.php?idJuego='.$this->idJuego]);//por ahora queda mas claro asi
        
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
       
            $html = <<<EOF
                $htmlErroresGlobales
                
            EOF;
            if(isset($_SESSION["login"])){
                $us=Usuario::buscaUsuario($_SESSION["username"]);
                $idUser = $us->getId();
                if(Comentarios::searchComment($idUser, $this->idJuego)|| (isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'])){
                    $html .= <<<EOF
                        <button type="submit" class="bEliminar"> Eliminar </button>
                        
                    EOF;
                }
            }
        return $html;
    }


    protected function procesaFormulario(&$datos) 
    {
        $us=Usuario::buscaUsuario($_SESSION["username"]);
        $idUser = $us->getId();
        if(isset($_SESSION["login"]) ){
            Comentarios::deleteComment($idUser, $this->idJuego);
        }
    }



}