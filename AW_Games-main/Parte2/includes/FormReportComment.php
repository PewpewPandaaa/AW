<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Comentarios.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Report.php';

class FormReportComment extends Formulario
{   
    private $id;

    private $idJuego;

    public function __construct($id,$idJuego) {
        $this->id = $id;
        $this->idJuego = $idJuego;
        parent::__construct('FormReportComment', ['enctype' => 'multipart/form-data', 'urlRedireccion' => 'infoJuego.php?idJuego='.$this->idJuego]);//por ahora asi, no me va que vuelva al juego
        
    }
    protected function generaCamposFormulario(&$datos)
    {
        $comentario = Comentarios::buscarComentario($this->id); 
        $usuario = Usuario::buscaPorId($comentario->getIdUsuario());
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['motivoReport'], $this->errores, 'span', array('class' => 'error'));
  
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.

        $html = <<<EOF
        
        $htmlErroresGlobales
        <div id= "annadirJuego">
            <span id = "games_info"> 
            <div id = "title">Reportar un comentario</div>
        </span>
        <br>

        <form enctype="multipart/form-data">
        <br>
          <div class="form-row">
          <label for="IdUsuario"> Publicado por ususario: </label>
          <p>{$usuario->getNombre()}</p>
         </div>
         <br>

         <div class = "form-row">
            <label for="contentComment"> Comentario a reportar: </label>
            <p>{$comentario->getComentario()}</p>
        </div>
         <br>
         
        <div class = "form-row">
        <label for="motivoReport"> Motivo por el cual reporta este comentario: </label>
        <textarea clase = "motivoReport" id="motivoReport" maxlength="100" name="motivoReport" ></textarea>

        {$erroresCampos['motivoReport']}
         
          <div>
          <span class="btn-recharge-container">
              <button onclick = "avisa()" type="submit" class = "btn-recharge" id = "btn-recharge" name="recargar">Enviar</button>
          </div>
          </span>
        
          </form>

          <script src="js/alert.js"> </script>

        EOF;       
        return $html;
    }

    protected function procesaFormulario(&$datos) 
    {   
        $comentario = Comentarios::buscarComentario($this->id);
        $usuario = Usuario::buscaPorId($comentario->getIdUsuario());
        $contenido = $comentario->getComentario();
        $nombreUsuario = $_SESSION['username'];
        $this->errores = [];

        $motivo = filter_var($datos['motivoReport'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( !  $motivo || empty( $motivo) ) {
            $this->errores['motivoReport'] = 'Debe decribir el motivo por el que reporta este comentario';
        }
        
            if(count($this->errores) === 0){
                
                if(Report::crearReport($usuario->getId(),$nombreUsuario,$this->id,$contenido,$motivo)){
                    echo "Se ha eviado el report con éxito";
                }
                
                
            }
      
    }


}


?>