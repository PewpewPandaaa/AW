<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Juego.php';
class FormAnnadirJuego extends Formulario{

    public function __construct() {
        parent::__construct('formAnnadirJuego', ['enctype' => 'multipart/form-data','urlRedireccion' => 'ListarJuegos.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
          // Se generan los mensajes de error si existen.
       $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
       $erroresCampos = self::generaErroresCampos(['imagen_juego','nombre', 'precio','genero','desarrollador','infoBasica'], $this->errores, 'span', array('class' => 'error'));
       // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
       $html = <<<EOF
       $htmlErroresGlobales
            <div id= "annadirJuego">
                <span id = "games_info"> 
                    <div id = "title">Registro de producto</div>
                </span>
                <br>
                <br>
                <br>
            
                <div class = "form-row">
                    <input required type="text" name= "nombre" id="nombre" placeholder="Nombre completo">
                    <span id="gameOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="gameNo">&#x274c;</span>
                    {$erroresCampos['nombre']}
                </div>
                
                <br>
            
                <div class="form-row">
                    <input required id="precio" type="text" name="precio" pattern="\d+(\.\d{2})?" placeholder="0.00" >
                    <span id="gamePriceOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="gamePriceNo">&#x274c;</span>
                    {$erroresCampos['precio']}
                </div>
                
                <br>
                
                <div class = "form-row">
                    <select name="genero" id="genero">
                        <option value="disparos"> disparos</option>
                        <option value="supervivencia"> supervivencia</option>
                        <option value="estrategia"> estrategia</option>
                        <option value="accion"> acción</option>
                        <option value="multijugador"> multijugador</option>
                    </select>
                    {$erroresCampos['genero']}
                </div>
                
                <br>
            
                <div class = "form-row">
                    
                    <input type="text" name= "desarrollador" id="desarrollador" placeholder="Nombre del desarrollador">
                    <span id="gameDOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="gameDNo">&#x274c;</span>
                    {$erroresCampos['desarrollador']}
                </div>
                
                <br>
                
                <div class = "form-row">
                  
                    <input type="text" name= "infoBasica" id="infoBasica" placeholder="Introduzca una breve descripcion">
                    <span id="gameInfoOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="gameInfoNo">&#x274c;</span>
                    {$erroresCampos['infoBasica']}
                </div>

              <br>
            
                <div class = "avatar_wrapper">
                    <input required type="file" name="imagen_juego" id="imagen_juego">
                    
                    {$erroresCampos['imagen_juego']}
                    
                <div>
                
            </div>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <div>
                <span class="btn-recharge-container">
                    <button type="submit" class = "btn-recharge" name="recargar">ACEPTAR</button>
                </span>
            </div>

       

       EOF;
       return $html;
    }

    protected function procesaFormulario(&$datos){

        $this->errores = [];
        
        //Imagen
        $filename = $_FILES['imagen_juego']['name'];
        $tempname = $_FILES['imagen_juego']['tmp_name'];    
        $folder = RUTA_IMGS."/juegos/".$filename;

        //nombre
        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || empty($nombre) ) {
            $this->errores['nombre'] = 'Campo nombre del juego no puede estar vacío';
        }

        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $precio || empty($precio) ) {
            $this->errores['precio'] = 'Necesita ajustarle un precio a su producto';
        }
        /*
        if(!preg_match('/^\d+\.\d{2}$/', $precio)){
            $this->errores['precio'] = 'El precio debe seguir el formato 0.00';
        }*/

        $genero = trim($datos['genero'] ?? '');
        $genero = filter_var($genero, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $genero || empty($genero) ) {
            $this->errores['genero'] = 'Seleccione un género';
        }

        $desarrollador = trim($datos['desarrollador'] ?? '');
        $desarrollador = filter_var($desarrollador, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $desarrollador || empty($desarrollador) ) {
            $this->errores['desarrollador'] = 'Campo desarrolador no puede estar vacío';
        }

        $infoBasica = trim($datos['infoBasica'] ?? '');
        $infoBasica = filter_var($infoBasica, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $infoBasica || empty($infoBasica) ) {
            $this->errores['infoBasica'] = 'Campo descripción no puede estar vacío';
        }

        if($filename == NULL){
            $this->errores['imagen_juego'] = 'No puede no tener imagen';
        }

        if (count($this->errores) === 0) {
            
            if (move_uploaded_file($tempname,$folder)){       
                if(Juego::crearJuego($nombre,$precio,$genero,$infoBasica,$desarrollador,$filename)){
                    echo "success";
                }
            }else{
                $this->errores['imagen_juego'] =  "Failed";
            }
 
        }

    }
    
}