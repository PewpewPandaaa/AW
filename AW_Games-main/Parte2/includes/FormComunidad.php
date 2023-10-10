<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Juego.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';

class FormComunidad extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        $this->idJuego = $idJuego;
        parent::__construct('FormComunidad'.$idJuego, ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'comunidadJuego.php?idJuego='.$this->idJuego]);//por ahora queda mas claro asi
        
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.

       $html = <<<EOF
            $htmlErroresGlobales
            <div class= "comentBox">

                <form enctype="multipart/form-data">
                <br><br>
                <!--<fieldset> -->
                    <label for="comentario"> <h4>Añadir Comentario:</h4></label>
        EOF;

        if(isset($_SESSION["login"])){
            $us=Usuario::buscaUsuario($_SESSION["username"]);
            $idUser = $us->getId();

            Usuario::checkMute($idUser);
            if(Usuario::isMute($idUser)){
                $html .= <<<EOF
                <textarea id='comentario' name='comentario' placeholder = 'Está usted muteado, no puedes comentar.' rows = '1' disabled></textarea>
                <button id = 'sendComment' type='submit'  style=' width: 35px; height: 25px;'> <img src = 'img/enviar.png' style=' width: 100%; height: 100%;'></button>
                <!--</fieldset>-->
                </form>
            </div>
            EOF;
            }else{
            $html .= <<<EOF
                <textarea id='comentario' name='comentario' placeholder = 'Deja aqui tus comentarios...' rows = '1' required></textarea>
                <button id = 'sendComment' type='submit'  style=' width: 35px; height: 25px;'> <img src = 'img/enviar.png' style=' width: 100%; height: 100%;'></button>
                <!--</fieldset>-->
                </form>
            </div>
            EOF;
            }
        }
        else  
            $html .= <<<EOF
                <textarea id='comentario' name='comentario' placeholder = 'Tienes que acceder para poder dejar comentarios.' rows = '1' disabled></textarea>
            EOF;

        return $html;
    }


    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){
            $comment = $_POST['comentario'];
            $us=Usuario::buscaUsuario($_SESSION["username"]);
            $idUser = $us->getId();

            Comentarios::crearComentario($this->idJuego, $idUser, $comment);
        }
    }



}
