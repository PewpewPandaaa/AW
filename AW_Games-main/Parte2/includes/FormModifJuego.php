<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
class FormModifJuego extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        $this->idJuego = $idJuego;
      
        parent::__construct('formModifJuego', ['enctype' => 'multipart/form-data','urlRedireccion' => 'infoJuego.php?idJuego='.$this->idJuego]);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $juego = Juego::buscarJuegoNombrePorId($this->idJuego); 
        
        // Se generan los mensajes de error si existen.
       $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
       $erroresCampos = self::generaErroresCampos(['imagen_juego','gamename','precio', 'infoGame', 'desarrollador','rebaja'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <div id= "user_content_wrapper">
        
          <div class = "avatar_wrapper">
          <img class="game-img" src="img/juegos/{$juego->getRutaImagen()}" alt="juego">
          <input type="file" name="imagen_juego">
          {$erroresCampos['imagen_juego']}
          </div>
          <br>  
        
        <div class="form-row">
            <label for="gamename"> Nombre Juego : </label>
            <input required id="gamename" type="text" name="gamename" value={$juego->getNombre()}>
            <span id="gamenameOK">
                <img src="img/tick.png">
            </span>
            <span id="gamenameNo">&#x274c;</span>
            {$erroresCampos['gamename']}
        </div>
        <br>
        <div class="form-row">
            <label for="precio"> Precio : </label>
            <input required id="precio" type="text" name="precio" pattern="\d+(\.\d{2})?" required value={$juego->getPrecio()}>
            <span id="gamePriceOK">
                <img src="img/tick.png">
            </span>
            <span id="gamePriceNo">&#x274c;</span>
            {$erroresCampos['precio']}
        </div>
        <br>
        <div class="form-row">
            <label for="rebaja"> Rebaja : </label>
            <input required id="rebaja" type="text" name="rebaja" pattern="\d+(\.\d{2})?" required placeholder="0.00">
            <span id="rebajaOK">
                <img src="img/tick.png">
            </span>
            <span id="rebajaNo">&#x274c;</span>
            {$erroresCampos['rebaja']}
        </div>
        <br>  
        <div class="form-row">
            <label for="desarrollador "> Desarrollador: </label>
            <input required id="desarrollador" type="text" name="desarrollador" value='{$juego->getDesarrollador()}'>
            <span id="gameDOK">
                <img src="img/tick.png">
            </span>
            <span id="gameDNo">&#x274c;</span>
            {$erroresCampos['desarrollador']}
        </div>
        <br>
        <br>
        <div id="game_info_wrapper">
            <label for="infoGame"> </label>
            <div id="lema-wrapper">
                <textarea required id="infoGame" maxlength="200" name="infoGame" >{$juego->getInfoBasica()}</textarea>
                <span id="GInfoOK">
                        <img src="img/tick.png">
                </span>
                <span id="GInfoNo">&#x274c;</span>
                {$erroresCampos['infoGame']}
            </div>
        </div>
        
        <div>
        <span class="btn-recharge-container">
            <button type="submit" class = "btn-recharge" name="recargar">ACEPTAR CAMBIOS</button>
        </div>
        </span>


        
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {   
        $juego = Juego::buscarJuegoNombrePorId($this->idJuego); 
        $this->errores = [];
        $nombreJuego = filter_var($datos['gamename'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreJuego || empty($nombreJuego) ) {
            $this->errores['nombreJuego'] = 'El nombre de juego no puede estar vacío';
        }

        $precio = trim($datos['precio']);
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $precio || empty($precio) ) {
            $this->errores['precio'] = 'El precio no puede estar vacio';
        }

        if(!preg_match('/^\d+\.\d{2}$/', $precio)){
            $this->errores['precio'] = 'El precio debe seguir el formato 0.00';
        }

        $rebaja = trim($datos['rebaja']);
        $rebaja = filter_var($rebaja, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $rebaja || empty($rebaja)) {
            $this->errores['rebaja'] = 'El precio de rebaja no puede estar vacio (si no desea rebaja mantenlo igual que el precio original )';
        }

        if(!preg_match('/^\d+\.\d{2}$/', $rebaja)){
            $this->errores['precio'] = 'El precio debe seguir el formato 0.00';
        }

        $desarrollador = filter_var($datos['desarrollador'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $desarrollador || empty($desarrollador) ) {
            $this->errores['desarrollador'] = 'El desarrollador no puede estar vacio';
        }

        $infoGame = filter_var($datos['infoGame'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $infoGame || empty($infoGame) ) {
            $this->errores['infoGame'] = 'El texto no puede estar vacío';
        }

        $filename = $_FILES['imagen_juego']['name'];
        $tempname = $_FILES['imagen_juego']['tmp_name'];    

        
       
    
        if (count($this->errores) === 0) {
            $juego->setNombre($this->idJuego,$nombreJuego);
            $juego->setPrecio($this->idJuego,$precio);

            if ($rebaja < $precio && $rebaja != 0){

                if (Juego::buscarJuegoReb($this->idJuego) ){
                    $jaux = Juego::buscarJuegoNombreReb1($this->idJuego);

                    if($jaux > $rebaja){
                        $juego->setPrecioReb($this->idJuego,$rebaja);
                    }
                }

                else{
                    Juego::insertarJuegoReb($this->idJuego,$rebaja);
                }
                
            }

            if ($rebaja >= $precio){
                if (Juego::buscarJuegoReb($this->idJuego) ){
                    Juego::eliminarJuegoReb($this->idJuego);
                }
            }
            $juego->setDesarrollador($this->idJuego,$desarrollador);
           $juego->setInfoBasica($this->idJuego,$infoGame);
          
           if($filename != NULL){
            $folder = RUTA_IMGS."/juegos/".$filename;
            if (move_uploaded_file($tempname,$folder)){
                $juego->setRutaImagen($filename, $this->idJuego);
           
            }
           
           
        }
    }

    }
}

?>