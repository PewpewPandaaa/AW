<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Juego.php';

class FormConfirmarPago extends Formulario
{

    private $idJuego;

    public function __construct($idJuego) {
        parent::__construct('FormConfirmarPago'.$idJuego,  ['urlRedireccion' => 'compraRealizada.php']);
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
        <button type="submit" class="btn_terminar"> <h3> PAGAR CON SALDO </h3></button>
        </div>
        
        EOF;
        return $html;
    }
    
    protected function procesaFormulario(&$datos) 
    {
        if(isset($_SESSION["login"])){
            $us=Usuario::buscaUsuario($_SESSION["username"]);
            $gmID=UsuarioCesta::getJuegoPorUsuario($us->getId());
            $precioTotal=0;

            foreach ($gmID as $gm_name){
                $juego = Juego::buscarJuegoPorNombre($gm_name); 
                $juegoId = $juego->getIdJuego();
             
            
                if(Juego::buscarJuegoReb($juegoId)){
                    $precio=Juego::buscarJuegoNombreReb1($juegoId);
                }else{
                    $precio=$juego->getPrecio();
                }  
                $precioTotal+=$precio;             

                $juegoComp=UsuarioG::insertarUsuarioJuego($us->getId(), $juego->getIdJuego(), $juego->getNombre(), $precio);

                if (Juego::buscarJuegoDes($us->getId(),$juegoId)){

                    $borrarGame = Usuariodeseo::eliminarJuegoDes($juegoId, $us->getId()); 
            
                }
            }
            $us->disminuirSaldo($us->getId(), $precioTotal);
            
            $vaciarCesta=UsuarioCesta::vaciarCestaUsuario($us->getId());
        }
        
    }



}


?>