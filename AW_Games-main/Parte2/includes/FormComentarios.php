<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Juego.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/UsuarioG.php';

class FormComentarios extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        $this->idJuego = $idJuego;
        parent::__construct('FormComentarios'.$idJuego, ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'infoJuego.php?idJuego='.$this->idJuego]);//por ahora queda mas claro asi
        
    }
    protected function generaCamposFormulario(&$datos)
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);

        //input type hidden
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.

        $html = <<<EOF
            $htmlErroresGlobales
                <span id = "games_info"> 
                    <div id = "title">Comentarios</div>
                </span>
                <br>
                <form enctype="multipart/form-data" id = "comm">
                <br><br>
                <!--<fieldset> -->
                    <label for="comentario"> <h4>My words:</h4></label>
        EOF;

        if(isset($_SESSION["login"])){
            $us=Usuario::buscaUsuario($_SESSION["username"]);
            $idUser = $us->getId();
            if(UsuarioG::searchGame($this->idJuego, $idUser))
                $html .= <<<EOF
                    
                    <textarea id = 'bComment' name='comentario' placeholder = 'Deja aqui tus comentarios...' rows = '1' required></textarea>
                    <button id = 'sendComment' type='submit'> <img  id = 'sendC' src = 'img/enviar.png'></button>
                    <br><br>
                    <div class="estrella">
                        <h4>Valoración</h4>
                        <input id="radio1" type="radio" name="estrellas" value="5"><label for="radio1" title="valorar 5 estrellas" >★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"><label for="radio2" title="valorar 4 estrellas">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"><label for="radio3" title="valorar 3 estrellas">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"><label for="radio4" title="valorar 2 estrellas">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"><label for="radio5" title="valorar 1 estrella">★</label>
                    </div>
                    
                EOF;
            else
                $html .= <<<EOF
                    <textarea id = 'bComment' name='comentario' placeholder = 'Tienes que comprar el juego para poder dejar comentarios.' rows = '1' disabled></textarea>
                    <button id = 'sendComment' type='submit' disabled> <img id = 'sendC' src = 'img/enviar.png'></button>
                    <div class="noEstrella">
                        <input id="radio1" type="radio" name="estrellas" value="5"><label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"><label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"><label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"><label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"><label for="radio5">★</label>
                    </div>
                EOF;
        }else  
            $html .= <<<EOF
                <textarea id = 'bComment' name='comentario' placeholder = 'Tienes que acceder para poder dejar comentarios.' rows = '1' disabled></textarea>
                <button id = 'sendComment' type='submit'  disabled> <img id = 'sendC' src = 'img/enviar.png' ></button>
                <div class="noEstrella">
                        <input id="radio1" type="radio" name="estrellas" value="5"><label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"><label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"><label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"><label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"><label for="radio5">★</label>
                </div>
            EOF;

        $html .= <<<EOF
                    
                <!--</fieldset>-->
                </form>
           
            EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){
            
            $comment = $_POST['comentario'];
            $us=Usuario::buscaUsuario($_SESSION["username"]);
            $idUser = $us->getId();
            $juego = Juego::buscarJuegoNombrePorId($this->idJuego);
            $nomJuego=$juego->getNombre();

            if(UsuarioG::searchGame($this->idJuego, $idUser)){
                if(Comentarios::searchComment($idUser, $this->idJuego)){
                    Comentarios::updateComment($idUser, $this->idJuego, $comment);
                }
                else{
                    Comentarios::addNewComment($idUser, $this->idJuego, $comment);
                } 
                if(isset($_POST['estrellas'])){
                    $valoracion = $_POST['estrellas'];
                    Comentarios::makeVal($valoracion, $idUser, $this->idJuego);
                    Comentarios::calcValOfGame($this->idJuego);
                }
            }
        }
    }

}


?>